<?php

	namespace Project\DatabaseLinks;

	use Project\_config\DAO;
	use Project\Classes\Entities\User;

	class UserDAO {

		public static function getAllUsers () {
			$datas = DAO::queryAll("SELECT * FROM user", null, "first");
			$result = [];
			foreach ($datas as $value) {
				$result[] = new User ($value['ID'], $value['MAIL'], $value['PASS'], $value['PSEUDO'], $value['PIC']);
			}
			return $result;
		}

		public static function updateUser ($user) {
			DAO::queryRow('UPDATE user SET id = ?, mail = ?, pass = ?, pseudo = ?, pic = ? WHERE ID = ?', [$user->getId(), $user->getMail(), $user->getPass(), $user->getPseudo(), $user->getPic()]);
		}

		public static function deleteUser ($user) {
			DAO::queryRow('DELETE FROM user WHERE ID = ?',[$user->getID()]);
		}

		public static function getUserByID ($ID) {
			$data = DAO::queryRow('SELECT * FROM user WHERE ID = ?',[$user->getID()]);$result = new User ($value['id'], $value['mail'], $value['pass'], $value['pseudo'], $value['pic']);			return $result;
		}


	}

?>