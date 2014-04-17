<?php

function generateTemplate($engine, $tpl, $contents, $extension='tpl') {

	echo $engine . ' ' . $tpl . ' template ';

	if (file_put_contents('../../templates/' . $engine . '/templates/' . $tpl . '.' . $extension, $contents())) {
		echo 'generated';
	}
	else {
		echo 'not generated ***';
	}
	echo '<hr>';

}