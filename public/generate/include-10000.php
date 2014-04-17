<?php

require_once '_lib.php';

$parentTplName = 'include-parent-10000';
$childTplName = 'include-child-10000';

/*
 * PHP
 */

generateTemplate('php', $parentTplName, function() {
	$tpl = array(
		'<?php',
	);
	for ($i=0; $i<10000; $i++) {
		$tpl[] = 'include "include-child-10000.php";';
	}
	return implode("\n", $tpl);
}, 'php');

generateTemplate('php', $childTplName, function() {
	return 'include ';
}, 'php');


/*
 * Smarty
 */

generateTemplate('smarty', $parentTplName, function() {
	$tpl = array();
	for ($i=0; $i<10000; $i++) {
		$tpl[] = '{include file="include-child-10000.tpl"}';
	}
	return implode("\n", $tpl);
});

generateTemplate('smarty', $childTplName, function() {
	return 'include ';
});

/*
 * Twig
 */

generateTemplate('twig', $parentTplName, function() {
	$tpl = array();
	for ($i=0; $i<10000; $i++) {
		$tpl[] = '{% include "include-child-10000.tpl" %}';
	}
	return implode("\n", $tpl);
});

generateTemplate('twig', $childTplName, function() {
	return 'include ';
});