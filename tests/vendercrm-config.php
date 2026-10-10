<?php
declare(strict_types=1);
// Synthetic fixtures only; never loads the deployment's config.php or sends HTTP.
$repo = dirname(__DIR__);
$helper = $repo . '/lib/vendercrm-config.php';
$bootstrap = file_get_contents($repo . '/lib/bootstrap.php');
$start = strpos($bootstrap, 'function cfg(');
$end = strpos($bootstrap, '/**', $start + 1);
if ($start === false || $end === false) { throw new RuntimeException('Loader extraction failed.'); }
$function = substr($bootstrap, $start, $end - $start);
$base = sys_get_temp_dir() . '/vendercrm-loader-' . bin2hex(random_bytes(8));
mkdir($base); mkdir($base . '/public'); mkdir($base . '/private'); mkdir($base . '/public/lib');
$public = $base . '/public';
$private = $base . '/private/vendercrm.php';
$count = 0;
function writeConfig(string $path, array $values): void { file_put_contents($path, '<?php return ' . var_export($values, true) . ';'); }
function fixture(string $public, string $function, string $helper): void {
    file_put_contents($public . '/bootstrap.php', '<?php define("ROOT_DIR", __DIR__);' . $function);
    copy($helper, $public . '/lib/vendercrm-config.php');
    writeConfig($public . '/config.example.php', ['SITE_URL' => 'https://site.example.com']);
}
function runCase(string $public, array $env, ?array $expected, bool $reject = false): void {
    global $count;
    $program = <<<'PHP'
<?php
$case = json_decode(stream_get_contents(STDIN), true);
foreach (['VENDERCRM_URL','VENDERCRM_API_KEY','VENDERCRM_CONFIG_FILE'] as $name) { putenv($name); }
foreach ($case['env'] as $name => $value) { putenv($name . '=' . $value); }
try {
    require $argv[1] . '/bootstrap.php';
    $actual = [cfg('VENDERCRM_URL'), cfg('VENDERCRM_API_KEY'), cfg('SITE_URL')];
    exit(!$case['reject'] && $actual === $case['expected'] ? 0 : 1);
} catch (RuntimeException $e) { exit($case['reject'] ? 0 : 2); }
PHP;
    $runner = dirname($public) . '/runner.php';
    file_put_contents($runner, $program);
    $process = proc_open([PHP_BINARY, $runner, $public], [['pipe','r'],['pipe','w'],['pipe','w']], $pipes);
    if (!is_resource($process)) { throw new RuntimeException('Cannot start synthetic process.'); }
    fwrite($pipes[0], json_encode(['env'=>$env,'expected'=>$expected,'reject'=>$reject])); fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]); fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]); fclose($pipes[2]);
    $status = proc_close($process);
    if ($status !== 0 || $stdout !== '' || $stderr !== '') { throw new RuntimeException('Synthetic loader case failed (no credential output).'); }
    $count++;
}
$pair = ['VENDERCRM_URL'=>'https://crm.example.com','VENDERCRM_API_KEY'=>'synthetic-private'];
$expected = ['https://crm.example.com','synthetic-private','https://site.example.com'];
try {
    fixture($public, $function, $helper);
    runCase($public, [], [null,null,'https://site.example.com']);
    writeConfig($public . '/config.php', ['VENDERCRM_URL'=>'https://legacy.example.com','VENDERCRM_API_KEY'=>'synthetic-legacy']);
    runCase($public, [], ['https://legacy.example.com','synthetic-legacy','https://site.example.com']);
    runCase($public, $pair, $expected); // Canonical env defeats stale legacy.
    runCase($public, ['VENDERCRM_URL'=>'https://crm.example.com'], null, true);
    runCase($public, ['VENDERCRM_API_KEY'=>'synthetic-private'], null, true);
    runCase($public, array_merge($pair, ['VENDERCRM_URL'=>'https://crm.example.com/api/v1/leads']), null, true);
    writeConfig($private, $pair);
    $original = file_get_contents($private);
    runCase($public, [], $expected); // Private canonical defeats stale legacy.
    runCase($public, $pair, $expected);
    runCase($public, array_merge($pair, ['VENDERCRM_API_KEY'=>'synthetic-conflict']), null, true);
    runCase($public, ['VENDERCRM_CONFIG_FILE'=>$public . '/config.php'], null, true);
    runCase($public, ['VENDERCRM_CONFIG_FILE'=>dirname($public) . '/missing.php'], null, true);
    // Replace only the synthetic public deployment; private configuration survives.
    foreach (['bootstrap.php','config.php','config.example.php','lib/vendercrm-config.php'] as $file) { unlink($public . '/' . $file); }
    rmdir($public . '/lib'); rmdir($public); mkdir($public); mkdir($public . '/lib');
    fixture($public, $function, $helper);
    runCase($public, [], $expected);
    if (file_get_contents($private) !== $original) { throw new RuntimeException('Private config changed across redeploy.'); }
    unlink($private);
    runCase($public, [], [null,null,'https://site.example.com']);
    echo "PASS: $count offline loader checks; private config survived deployment replacement.\n";
} finally {
    foreach (['public/bootstrap.php','public/config.php','public/config.example.php','public/lib/vendercrm-config.php','private/vendercrm.php','runner.php'] as $file) {
        if (is_file($base . '/' . $file)) { unlink($base . '/' . $file); }
    }
    rmdir($public . '/lib'); rmdir($public); rmdir($base . '/private'); rmdir($base);
}
