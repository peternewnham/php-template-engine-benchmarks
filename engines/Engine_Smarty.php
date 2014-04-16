<?php

require_once ('Engine.php');

class Engine_Smarty extends Engine {

	public function setTemplateDir($dir) {

		parent::setTemplateDir($dir . '/smarty/templates');

	}

	public function setCompiledDir($dir) {

		parent::setCompiledDir($dir . '/smarty/compiled');

	}

	public function initialise() {

		$smarty = new Smarty();
		$smarty->setTemplateDir($this->templateDir);
		$smarty->setCompileDir($this->compiledDir);
		$smarty->compile_check = false;
		$smarty->escape_html = false;

		if (false === $this->useCache) {
			$smarty->clearCompiledTemplate();
		}

		return $smarty;

	}

	public function terminate($smarty) {

		$smarty = null;

	}

	public function run($reset=false) {

		$data = $this->getData();

		$template = $this->template . '.tpl';

		$start = microtime(true);
		$mem = memory_get_peak_usage();

		$smarty = $this->initialise();

		$smarty->assign($data);
		$content = $smarty->fetch($template);

		$end = microtime(true)-$start;
		$mem = memory_get_peak_usage() - $mem;

		if ($this->output) {
			die($content);
		}

		$this->terminate($smarty);

		return array(
			'time' => $end,
			'memory' => $mem
		);

	}

}