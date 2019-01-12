<?php

	namespace Project\DatabaseLinks;

	use Project\_config\DAO;
	use Project\Classes\Entities\Mytable;

	class MytableDAO {

		public static function getAllMytables () {
			$datas = DAO::queryAll("SELECT * FROM mytable");
			$result = [];
			foreach ($datas as $value) {
				$result[] = new Mytable ($value['id'], $value['mail'], $value['pseudo'], $value['name']);			}
			return $result;

		}

		public static function updateMytable ($mytable) {
			DAO::queryRow('UPDATE mytable SET mail = ?, pseudo = ?, name = ? WHERE id = ?', [$mytable->getMail(), $mytable->getPseudo(), $mytable->getName()]);
		}

		public static function deleteMytable ($mytable) {
			DAO::queryRow('DELETE FROM mytable WHERE id = ?',[$mytable->getId()]);
		}

		public static function getMytableById ($id) {
			$data = DAO::queryRow('SELECT * FROM mytable WHERE id = ?',[$mytable->getId()]);$result = new Mytable ($value['id'], $value['mail'], $value['pseudo'], $value['name']);			return $result;		}


	}

?>