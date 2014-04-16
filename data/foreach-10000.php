<?php

$data = array(
	'data' => array()
);

for ($i=0; $i<10000; $i++) {

	$data['data']["var" . $i] = "var" . $i;

}

return $data;