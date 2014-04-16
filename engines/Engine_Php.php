<?php

require_once ('Engine.php');

class Engine_Php extends Engine {

	public function setTemplateDir($dir) {

		parent::setTemplateDir($dir . '/php/templates');

	}

	public function setCompiledDir($dir) {

		parent::setCompiledDir($dir . '/php/compiled');

	}

	public function initialise() {}

	public function terminate($php) {}

	public function run() {

		$data = $this->getData();
		if (is_array($data)) {
			extract($data);
		}

		$template = $this->templateDir . '/' . $this->template . '.php';

		$start = microtime(true);
		$mem = memory_get_peak_usage();

		ob_start();
		include $template;
		$content = ob_get_contents();
		ob_end_clean();
		
		$end = microtime(true)-$start;
		$mem = memory_get_peak_usage() - $mem;

		if ($this->output) {
			die($content);
		}

		$this->terminate(null);

		return array(
			'time' => $end,
			'memory' => $mem
		);

	}

}