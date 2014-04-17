<?php

require_once '_lib.php';

$tplName = 'variables-1000';

/*
 * PHP
 */

generateTemplate('php', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<1000; $i++) {
		$tpl .= '<?=htmlspecialchars($var' . $i . ')?> ';
	}
	return $tpl;
}, 'php');

/*
 * Smarty
 */

generateTemplate('smarty', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<1000; $i++) {
		$tpl .= '{$var' . $i . '} ';
	}
	return $tpl;
});

/*
 * Twig
 */

generateTemplate('twig', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<1000; $i++) {
		$tpl .= '{{ var' . $i . ' }} ';
	}
	return $tpl;
});