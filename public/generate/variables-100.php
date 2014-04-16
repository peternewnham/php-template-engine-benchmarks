<?php

require '_lib.php';

$tplName = 'variables-100';

/*
 * PHP
 */

generateTemplate('php', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<100; $i++) {
		$tpl .= '<?=htmlspecialchars($var' . $i . ');?> ';
	}
	return $tpl;
}, 'php');

/*
 * Smarty
 */

generateTemplate('smarty', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<100; $i++) {
		$tpl .= '{$var' . $i . '|escape} ';
	}
	return $tpl;
});

/*
 * Twig
 */

generateTemplate('twig', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<100; $i++) {
		$tpl .= '{{ var' . $i . ' }} ';
	}
	return $tpl;
});