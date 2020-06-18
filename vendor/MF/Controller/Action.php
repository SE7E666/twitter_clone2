<?php

namespace MF\Controller;

abstract class Action {
	protected $view;

	public function __construct() {
		$this->view = new \stdClass();//classe nativa do php
	}

		//Abstraindo o require:
	protected function render($view, $layout = 'layout') {
		$this->view->page = $view;
		//verificando se existe o layout e gerando ação caso não exista:
		if (file_exists("../app/Views/".$layout.".phtml")) {
			require_once "../app/Views/".$layout.".phtml";
		} else {
			$this->content();
		}
		
	}

	protected function content() {
		$classeAtual = get_class($this);

		$classeAtual = str_replace('App\\Controllers\\', '', $classeAtual);

		$classeAtual = strtolower(str_replace('Controller','', $classeAtual));

		require_once "../app/Views/".$classeAtual."/".$this->view->page.".phtml";
	}
} 

?>