<?php 
	
	namespace Project\DatabaseLinks;

	use Project\_config\DAO;
	use Project\Classes\Entities\User;
	

	class UserDAO {

		public static function getAllUsers () {
			$datas = DAO::queryAll("SELECT * FROM User");
			$result = [];
			foreach ($datas as $value) {
				$result[] = new User($value["ID"], $value["MAIL"], $value["PASS"], $value["PSEUDO"], $value["PIC"]);
			}
			return $result;
		}

		public static function getUserById ($id) {
			$datas = DAO::queryRow("SELECT * FROM User WHERE ID = ?", [$id]);
			$result = new User($datas["ID"], $datas["MAIL"], $datas["PASS"], $datas["PSEUDO"], $datas["PIC"]);
			return $result;
		}

		public static function updateUser ($user) {
			DAO::queryRow("UPDATE User SET MAIL = ?, PASS = ?, PSEUDO = ?, PIC = ? WHERE ID = ?", [$user->getMail(), $user->getPass(), $user->getPseudo(), $user->getPic(), $user->getId()]);
		}

		public static function deleteUser ($user) {
			DAO::queryRow("DELETE FROM User WHERE ID = ?", [$user->getId()]);
		}

	}


?>