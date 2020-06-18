<?php

namespace App\Controllers;

//recursos do miniframework:
use MF\Controller\Action; 
use MF\Model\Container;





class IndexController extends Action {
	public function index() {

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse() {
		$this->view->usuario = array(
				'nome' => '',
				'email' => '',
				'senha' => '',
			);

		$this->view->erroCadastro = false;	

		$this->render('inscreverse');
	}

	public function registrar() {
		//receber dados do formulário:

		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);
		//salvando objeto no bd, através da função salvar em models/Usuario.php
		//Verificando se já existe cadastro do email do usuário:
		if ($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {
				//salvando novo usuário:
				$usuario->salvar();
				//em caso de sucesso, vamos passar a view cadastro:
				$this->render('cadastro');
		} else {
			//não apagando os dados já preenchidos pelo usuário (pegando pelo metodo _POST)
			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);
			//agora vamos trabalhar um feedback no caso de erro:
			$this->view->erroCadastro = true;
			//em caso de erro, começaremos renderizando a view inscrever-se:
			$this->render('inscreverse');
		}
		

		//sucesso:

		//erro:

	}
}
?>