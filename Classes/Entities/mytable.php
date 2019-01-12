<?php

	namespace Project\Classes\Entities;

	class Mytable {

		private $id = null;
		private $mail = null;
		private $pseudo = null;
		private $name = null;

		public function __construct ($id, $mail, $pseudo, $name) {
			$this->id = $id;
			$this->mail = $mail;
			$this->pseudo = $pseudo;
			$this->name = $name;
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

		public function getPseudo () {
			return $this->pseudo;
		}

		public function setPseudo ($pseudo) {
			$this->pseudo = $pseudo;
		}

		public function getName () {
			return $this->name;
		}

		public function setName ($name) {
			$this->name = $name;
		}

	}

?>