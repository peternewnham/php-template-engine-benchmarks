<?php

require_once ('Engine.php');

class Engine_Twig extends Engine {

	public function __construct() {

		// initialise twig autoloader
		Twig_Autoloader::register();

	}

	public function setTemplateDir($dir) {

		parent::setTemplateDir($dir . '/twig/templates');

	}

	public function setCompiledDir($dir) {

		parent::setCompiledDir($dir . '/twig/compiled');

	}

	public function initialise() {

		$loader = new Twig_Loader_Filesystem($this->templateDir);

		$twig = new Twig_Environment($loader, array(
			'cache' => $this->compiledDir,
			'strict_variables'=> true,
			'autoescape' => true
		));

		if (false === $this->useCache) {
			$twig->clearTemplateCache();
			$twig->clearCacheFiles();
			$twig->setCache(false);
		}

		return $twig;

	}

	public function terminate($twig) {

		$twig = null;

	}

	public function run() {

		$data = $this->getData();

		$template = $this->template . '.tpl';

		$start = microtime(true);
		$mem = memory_get_peak_usage();

		$twig = $this->initialise();

		$template = $twig->loadTemplate($template);
		$content = $template->render($data);
		
		$end = microtime(true)-$start;
		$mem = memory_get_peak_usage() - $mem;

		if ($this->output) {
			die($content);
		}

		$this->terminate($twig);

		return array(
			'time' => $end,
			'memory' => $mem
		);

	}

}