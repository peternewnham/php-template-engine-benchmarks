<?php

abstract class Engine {

	protected $dataDir;
	protected $templateDir;
	protected $compiledDir;
	protected $useCache;

	protected $template;

	protected $instance;

	protected $output = false;

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

}