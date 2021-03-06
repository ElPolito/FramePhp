<?php

	namespace Project\Classes\Entities;

	class User {

		private $id = null;
		private $mail = null;
		private $pass = null;
		private $pseudo = null;
		private $pic = null;

		public function __construct ($id, $mail, $pass, $pseudo, $pic) {
			$this->id = $id;
			$this->mail = $mail;
			$this->pass = $pass;
			$this->pseudo = $pseudo;
			$this->pic = $pic;
		}

		public function getId () {
			return $this->id;
		}

		public function setId ($id) {
			$this->id = $id;
		}

		public function getMail () {
			return $this->mail;
		}

		public function setMail ($mail) {
			$this->mail = $mail;
		}

		public function getPass () {
			return $this->pass;
		}

		public function setPass ($pass) {
			$this->pass = $pass;
		}

		public function getPseudo () {
			return $this->pseudo;
		}

		public function setPseudo ($pseudo) {
			$this->pseudo = $pseudo;
		}

		public function getPic () {
			return $this->pic;
		}

		public function setPic ($pic) {
			$this->pic = $pic;
		}

	}

?>