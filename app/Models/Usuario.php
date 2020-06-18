<?php
	namespace App\Models;

	use MF\Model\Model;

	class Usuario extends Model {
		private $id;
		private $nome;
		private $email;
		private $senha;

		public function __get($atributo) {
			return $this->$atributo;
		}

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}

		//salvar
		public function salvar() {
			$query = "insert into usuarios(nome, email, senha) values(:nome, :email, :senha)";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':nome', $this->__get('nome'));
			$stmt->bindValue(':email', $this->__get('email'));
			$stmt->bindValue(':senha', $this->__get('senha'));//na senha iremos usar o método de criptografia md5 -> hash de 32 caracteres
			$stmt->execute();

			return $this;
		}
		//validar se o cadastro pode ser feito
		public function validarCadastro() {
			$valido = true;
			//verificando se o atributo nome tem o lenght de pelo menos 3 caracteres:
			if(strlen($this->__get('nome')) < 3) {
				$valido = false;
			}
			//verificando se o atributo email tem o lenght de pelo menos 3 caracteres:
			if(strlen($this->__get('email')) < 3) {
				$valido = false;
			}//verificando se o atributo senha tem o lenght de pelo menos 3 caracteres:
			if(strlen($this->__get('senha')) < 3) {
				$valido = false;
			}
			return $valido;
		}
		//recuperar um usuário por email
		public function getUsuarioPorEmail() {
			$query = "select nome, email from usuarios where email = :email";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':email', $this->__get('email'));
			$stmt->execute();

			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function autenticar() {
			$query = "select id, nome, email from usuarios where email = :email and senha = :senha";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':email', $this->__get('email'));
			$stmt->bindValue(':senha', $this->__get('senha'));
			$stmt->execute();

			$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

			if($usuario['id'] != '' && $usuario['nome'] != '') {
				//se estas 2 condiçoes forem aceitas, podemos passar:
				$this->__set('id', $usuario['id']);
				$this->__set('nome', $usuario['nome']);
			}

			return $this;
		}
	}

?>
