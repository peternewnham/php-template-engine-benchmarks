<?php

require '_lib.php';

$tplName = 'echo-1000';

/*
 * PHP
 */
generateTemplate('php', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<1000; $i++) {
		$tpl .= '<?=htmlspecialchars($var);?> ';
	}
	return $tpl;
}, 'php');

/*
 * Smarty
 */

generateTemplate('smarty', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<1000; $i++) {
		$tpl .= '{$var|escape} ';
	}
	return $tpl;
});

/*
 * Twig
 */

generateTemplate('twig', $tplName, function() {
	$tpl = '';
	for ($i=0; $i<1000; $i++) {
		$tpl .= '{{ var }} ';
	}
	return $tpl;
});