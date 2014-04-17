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

		if (false === $this->useCache) {
			$this->clearCompiled();
		}

		$data = $this->getData();
		if (is_array($data)) {
			extract($data);
		}

		$template = $this->templateDir . '/' . $this->template . '.php';

		$this->startProfiler();

		$templateHash = md5($template);
		$compiled = $this->compiledDir . '/' . $templateHash;

		if (file_exists($compiled)) {
			$content = file_get_contents($compiled);
		}
		else {
			ob_start();
			include $template;
			$content = ob_get_contents();
			ob_end_clean();
			file_put_contents($compiled, $content);
		}

		$results = $this->endProfiler();

		if ($this->output) {
			die($content);
		}

		$this->terminate(null);

		return $results;

	}

}