<?php

set_time_limit(0);

$baseDir = preg_replace('#\/\w+$#', '', __DIR__);

$dataDir = $baseDir . '/data';
$templateDir = $baseDir . '/templates';

$engine = htmlspecialchars($_GET['engine'], ENT_QUOTES);
$test = htmlspecialchars($_GET['test'], ENT_QUOTES);
$cache = $_GET['cache'] === '1';

require $baseDir . '/vendor/autoload.php';

$class = 'Engine_' . ucwords($engine);

require_once($baseDir . '/engines/' . $class . '.php');

$engine = new $class($test);
$engine->setDataDir($dataDir);
$engine->setTemplateDir($templateDir);
$engine->setCompiledDir($templateDir);
$engine->setUseCache($cache);
$engine->setTemplate($test);

$result = $engine->run();

echo json_encode($result);