<?php

namespace App\Controllers;

//recursos do miniframework:
use MF\Controller\Action; 
use MF\Model\Container;





class AuthController extends Action {

	public function autenticar() {
		
		$usuario = Container::getModel('Usuario');

		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);

		
		$retorno = $usuario->autenticar();

		//se houver usuário:
		if($usuario->__get('id') != '' && $usuario->__get('nome')) {
			//se chegou aqui, usuário foi autenticado, então vamos iniciar a Session:
			session_start();

			$_SESSION['id'] = $usuario->__get('id'); 
			$_SESSION['nome'] = $usuario->__get('nome');
			//agora podemos forçar o redirecionamento para uma página que seja protegida:
			header('Location: /timeline');
		} else {
			//em caso de erro na autenticação, usaremos o método 'header' nativo do php:
			header('Location: /?login=erro');
		}

	}
}
?>