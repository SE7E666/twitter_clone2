<?php

	namespace App;

	class Connection {

		public static function getDb() {
			try {

				$conn = new \PDO(
					"mysql:host=localhost;dbname=twitter_clone;charset=utf8",
					"root",
					""
				);
				return $conn;

			} catch (\PDOException $e) {
				echo 'Mensagem do erro '. $e->getMessage() . ' código do erro '.$e->getCode();
			}
		}

	}

?>