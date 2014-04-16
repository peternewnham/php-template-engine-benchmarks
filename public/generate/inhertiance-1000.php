<?php

require '_lib.php';

$parentTplName = 'inheritance-parent-1000';
$childTplName = 'inheritance-child-1000';

/*
 * PHP
 */

generateTemplate('php', $parentTplName, function() {
	$tpl = array(
		'<?php',
		'$parent = "";'
	);
	for ($i=0; $i<1000; $i++) {
		$tpl[] = '$parent .= "{block name=block' . $i . '}";';
	}
	$tpl[] = 'return $parent;';
	return implode("\n", $tpl);
}, 'php');

generateTemplate('php', $childTplName, function() {
	$tpl = array(
		'<?php',
		'$parent = include "inheritance-parent-100.php";'
	);
	for ($i=0; $i<1000; $i++) {
		$tpl[] = '$parent = str_replace("{block name=block' . $i . '}", "block' . $i . '", $parent);';
	}
	$tpl[] = 'echo $parent;';
	return implode("\n", $tpl);
}, 'php');

/*
 * Smarty
 */

generateTemplate('smarty', $parentTplName, function() {
	$tpl = array();
	for ($i=0; $i<1000; $i++) {
		$tpl[] = '{block name=block' . $i . '}{/block}';
	}
	return implode("\n", $tpl);
});

generateTemplate('smarty', $childTplName, function() {
	$tpl = array('{extends file="inheritance-parent-1000.tpl"}');
	for ($i=0; $i<1000; $i++) {
		$tpl[] = '{block name=block' . $i . '}block ' . $i . '{/block}';
	}
	return implode("\n", $tpl);
});

/*
 * Twig
 */

generateTemplate('twig', $parentTplName, function() {
	$tpl = array();
	for ($i=0; $i<1000; $i++) {
		$tpl[] = '{% block block' . $i . ' %}{% endblock %}';
	}
	return implode("\n", $tpl);
});

generateTemplate('twig', $childTplName, function() {
	$tpl = array('{% extends "inheritance-parent-1000.tpl" %}');
	for ($i=0; $i<1000; $i++) {
		$tpl[] = '{% block block' . $i . ' %}block ' . $i . '{% endblock %}';
	}
	return implode("\n", $tpl);
});