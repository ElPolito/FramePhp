<?php

	namespace Project\Classes\Entities;

	class Player {
		private $id = null;
		private $name = null;
		private $pseudo = null;
		private $mail = null;
		private $password = null;

		public function __construct ($id, $name, $pseudo, $mail, $password) {
			$this->id = $id;
			$this->name = $name;
			$this->pseudo = $pseudo;
			$this->mail = $mail;
			$this->password = $password;
		}
		public function getId () {
			return $this->id;
		}

		public function setId ($id) {
			$this->id = $id;
		}

		public function getName () {
			return $this->name;
		}

		public function setName ($name) {
			$this->name = $name;
		}

		public function getPseudo () {
			return $this->pseudo;
		}

		public function setPseudo ($pseudo) {
			$this->pseudo = $pseudo;
		}

		public function getMail () {
			return $this->mail;
		}

		public function setMail ($mail) {
			$this->mail = $mail;
		}

		public function getPassword () {
			return $this->password;
		}

		public function setPassword ($password) {
			$this->password = $password;
		}
	}

?>