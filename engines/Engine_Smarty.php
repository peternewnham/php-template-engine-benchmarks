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
		$smarty->default_modifiers = array(
			'escape:"htmlall"'
		);

		/*if (false === $this->useCache) {
			$smarty->clearCompiledTemplate();
		}*/

		return $smarty;

	}

	public function terminate($smarty) {

		$smarty = null;

	}

	public function run() {

		if (false === $this->useCache) {
			$this->clearCompiled();
		}

		$data = $this->getData();

		$template = $this->template . '.tpl';

		$this->startProfiler();

		$smarty = $this->initialise();

		$smarty->assign($data);
		$content = $smarty->fetch($template);

		$results = $this->endProfiler();

		if ($this->output) {
			die($content);
		}

		$this->terminate($smarty);

		return $results;

	}

}