<?php

abstract class Engine {

	protected $dataDir;
	protected $templateDir;
	protected $compiledDir;
	protected $useCache;

	protected $template;

	protected $instance;

	protected $output = false;

	private $timer;
	private $memory;

	public function setDataDir($dir) {
		$this->dataDir = $dir;
	}

	public function setTemplateDir($dir) {
		$this->templateDir = $dir;
	}

	public function setCompiledDir($dir) {
		$this->compiledDir = $dir;
	}

	public function setUseCache($use) {
		$this->useCache = (bool)$use;
	}

	public function setTemplate($template) {
		$this->template = $template;
	}

	protected abstract function initialise();

	protected abstract function terminate($instance);

	protected function getData() {

		$dataFile = $this->dataDir . '/' . $this->template . '.php';

		if (file_exists($dataFile)) {

			$data = include($this->dataDir . '/' . $this->template . '.php');

		}
		else {

			$data = array();

		}

		return $data;

	}

	protected function clearCompiled() {

		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($this->compiledDir, RecursiveDirectoryIterator::SKIP_DOTS),
			RecursiveIteratorIterator::CHILD_FIRST
		);

		$ignore = array(
			'.gitignore'
		);

		foreach ($files as $file) {
			$path = $file->getPathname();
			if (!preg_match('/\.gitignore$/', $path)) {
				$file->isFile() ? unlink($file->getPathname()) : rmdir($file->getPathname());
			}
		}

	}

	protected function startProfiler() {

		$this->timer = microtime(true);
		$this->memory = memory_get_peak_usage();

	}

	protected function endProfiler() {

		$memory = memory_get_peak_usage(true) - $this->memory;
		$time = microtime(true) - $this->timer;

		return array(
			'memory' => $memory,
			'time' => $time
		);

	}

}