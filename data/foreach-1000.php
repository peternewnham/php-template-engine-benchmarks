<?php

$data = array(
	'data' => array()
);

for ($i=0; $i<1000; $i++) {

	$data['data']["var" . $i] = "var" . $i;

}

return $data;