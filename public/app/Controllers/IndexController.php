<?php

namespace App\Controllers;

//recursos do miniframework:
use MF\Controller\Action; 
use MF\Model\Container;





class IndexController extends Action {
	public function index() {

		$this->render('index');
	}
}
?>