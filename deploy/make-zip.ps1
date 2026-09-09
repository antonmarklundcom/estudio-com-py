# Windows twin of deploy/make-zip.sh - same staging list, same output, but
# the archive is written with .NET so every entry path uses forward slashes.
#
#     powershell -ExecutionPolicy Bypass -File deploy/make-zip.ps1
#     -> dist/<slug>-YYYY-MM-DD.zip
#
# Why not Compress-Archive or the Explorer "Send to -> zip"? Both write
# backslash entry names ("partials\head.php"); Linux hosting extracts those as
# literal files called "partials\head.php" in public_html/, every include
# fails, and the whole site 500s. This script normalises every entry name to
# "/" and verifies the archive contains no backslash before it reports success.
#
# Keep the SHIP list and the exclusions in step with make-zip.sh.

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$Root  = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
$Stamp = Get-Date -Format 'yyyy-MM-dd'
# php -r quoting is fragile under PowerShell; a throwaway script file is not.
$slugScript = Join-Path $env:TEMP 'make-zip-slug.php'
Set-Content -Path $slugScript -Encoding ascii -Value @(
    '<?php',
    'require $argv[1] . "/lib/bootstrap.php";',
    'echo preg_replace("/[^a-z0-9-]/", "", (string) site("slug"));'
)
$Slug  = (& php $slugScript $Root)
if (-not $Slug) { $Slug = 'site' }
$Name  = "$Slug-$Stamp"
$Dist  = Join-Path $Root 'dist'
$Stage = Join-Path $Dist $Name
$Zip   = Join-Path $Dist "$Name.zip"

if (Test-Path $Stage) { Remove-Item -Recurse -Force $Stage }
if (Test-Path $Zip)   { Remove-Item -Force $Zip }
New-Item -ItemType Directory -Force $Stage | Out-Null

$Ship = @('index.php', '404.php', 'enviar.php', 'sitemap.php', 'robots.php', 'router.php',
          '.htaccess', 'config.example.php', 'assets', 'content', 'lib', 'partials', 'templates')
foreach ($item in $Ship) {
    $src = Join-Path $Root $item
    if (-not (Test-Path $src)) { throw "missing: $item" }
    Copy-Item -Recurse -Force $src (Join-Path $Stage $item)
}

# Minified stylesheet ships under the source's name (see make-zip.sh).
if (Get-Command node -ErrorAction SilentlyContinue) {
    & node (Join-Path $Root 'deploy/minify-css.mjs')
}
$min = Join-Path $Root 'assets/css/site.min.css'
if (Test-Path $min) {
    Copy-Item -Force $min (Join-Path $Stage 'assets/css/site.css')
    Remove-Item -Force (Join-Path $Stage 'assets/css/site.min.css')
} else {
    Write-Warning 'no assets/css/site.min.css (run deploy/minify-css.mjs), shipping unminified site.css'
}

# Every top-level directory with an index.php anywhere under it.
$pageDirs = Get-ChildItem -Path $Root -Recurse -Filter 'index.php' -File |
    Where-Object { $_.FullName -notlike "$Dist*" -and $_.FullName -notlike (Join-Path $Root 'tests*') } |
    ForEach-Object { $_.FullName.Substring($Root.Length + 1) -split '[\\/]' | Select-Object -First 1 } |
    Where-Object { $_ -ne 'index.php' } | Sort-Object -Unique
foreach ($dir in $pageDirs) {
    Copy-Item -Recurse -Force (Join-Path $Root $dir) (Join-Path $Stage $dir)
}

New-Item -ItemType Directory -Force (Join-Path $Stage 'logs') | Out-Null
Set-Content -Path (Join-Path $Stage 'logs/.htaccess') -Value 'Require all denied' -Encoding ascii
New-Item -ItemType File -Force (Join-Path $Stage 'logs/.gitkeep') | Out-Null

foreach ($forbidden in @('docs', 'prompts', 'tests', 'deploy', '.git', 'config.php', 'dist', 'plan.md', 'README.md', 'KNOWN-ISSUES.md')) {
    if (Test-Path (Join-Path $Stage $forbidden)) { throw "refusing to ship: $forbidden" }
}

# Flat archive with forward-slash entry names.
$archive = [System.IO.Compression.ZipFile]::Open($Zip, [System.IO.Compression.ZipArchiveMode]::Create)
try {
    $files = Get-ChildItem -Path $Stage -Recurse -File -Force
    foreach ($f in $files) {
        $entry = $f.FullName.Substring($Stage.Length + 1) -replace '\\', '/'
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($archive, $f.FullName, $entry,
            [System.IO.Compression.CompressionLevel]::Optimal) | Out-Null
    }
} finally {
    $archive.Dispose()
}

# Belt and braces: no backslash may survive in any entry name.
$check = [System.IO.Compression.ZipFile]::OpenRead($Zip)
try {
    $bad = @($check.Entries | Where-Object { $_.FullName -match '\\' })
    $count = $check.Entries.Count
} finally {
    $check.Dispose()
}
if ($bad.Count -gt 0) { throw "backslash entry names in zip: $($bad[0].FullName)" }

$size = [math]::Round((Get-Item $Zip).Length / 1KB)
Write-Output "dist/$Name.zip  (${size} KB, $count files, all entry paths use '/')"
Write-Output "staged at dist/$Name/ - verify it with:  ./verify.sh --root dist/$Name"
