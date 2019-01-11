<?php 

namespace Project\_config;

use Project\_config\hide\DB;

abstract class DAO {

	private static function _query ($sql, $args = null, $db = null) {
		$db = DB::getDB($db);
		if($args == null) {
			$pdos = $db->query($sql);
		}else{
			$pdos = $db->prepare($sql);
			$pdos->execute($args);
		}
		return $pdos;
	}

	public static function queryRow ($sql, $args = null, $db = null) {
		try {
			$pdos = DAO::_query($sql, $args, $db);
			$res = $pdos->fetch();
			$pdos->closeCursor();
		}catch(PDOException $e) {
			$res = false;
			$this->_error = 'query';
			if(DEBUG_GLOBAL || DEBUG_DB){
				die($e->getMessage);
			}
		}
		return $res;
	}

	public static function queryAll ($sql, $args = null, $db = null) {
		try {
			$pdos = DAO::_query($sql, $args, $db);
			$res = $pdos->fetchAll();
			$pdos->closeCursor();
		}catch(PDOException $e) {
			$res = false;
			$this->_error = 'query';
			if(DEBUG_GLOBAL || DEBUG_DB){
				die($e->getMessage);
			}
		}
		return $res;
	}

}


?>