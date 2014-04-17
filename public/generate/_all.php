<?php

$files = new RecursiveIteratorIterator(
	new RecursiveDirectoryIterator(__DIR__, RecursiveDirectoryIterator::SKIP_DOTS),
	RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $file) {
	if (!preg_match('/_[^\/]+\.php$/', $file->getPathname())) {
		include $file->getPathname();
		echo '<hr>';
	}
}