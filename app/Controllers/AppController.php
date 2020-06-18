<?php

namespace App\Controllers;

//recursos do miniframework:
use MF\Controller\Action; 
use MF\Model\Container;


class AppController extends Action {

	public function timeline() {
		//podemos recuperar a session:
		session_start();
		//antes de q1qr coisa, precisamos proteger a rota, verificando se ID e nome foram preenchidos:
		if($_SESSION['id'] =! '' && $_SESSION['nome'] =! '') {
			echo "<pre>";
			print_r($_SESSION);
			echo "</pre>";
		} else {
			header('Location: /?login=erro');
		}
	}
}
	

?>