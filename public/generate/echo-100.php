<?php

require_once '_lib.php';

$tplName = 'echo-100';

/*
 * PHP
 */
generateTemplate('php', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<100; $i++) {
		$tpl .= '<?=htmlspecialchars($var);?> ';
	}
	return $tpl;
}, 'php');

/*
 * Smarty
 */

generateTemplate('smarty', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<100; $i++) {
		$tpl .= '{$var} ';
	}
	return $tpl;
});

/*
 * Twig
 */

generateTemplate('twig', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<100; $i++) {
		$tpl .= '{{ var }} ';
	}
	return $tpl;
});