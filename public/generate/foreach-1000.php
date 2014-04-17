<?php

require_once '_lib.php';

$tplName = 'foreach-1000';

/*
 * PHP
 */

generateTemplate('php', $tplName, function() {
	$tpl = '<?php
foreach ($data as $value) {
	echo htmlspecialchars($value) . " ";
}';
	return $tpl;
}, 'php');

/*
 * Smarty
 */

generateTemplate('smarty', $tplName, function() {
	$tpl = '{foreach from=$data item=value}
	{$value}
{/foreach}';
	return $tpl;
});

/*
 * Twig
 */

generateTemplate('twig', $tplName, function() {
	$tpl = '{% for value in data %}
	{{ value }}
{% endfor %}';
	return $tpl;
});