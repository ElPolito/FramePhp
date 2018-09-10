<?php 
	

	// This is a demo class for your users the variables should be on your database
	/*
	You should create an entity for each table you have in your database except for link tables
	*/
	class User {

		// Variables ...
		private $id = null;
		private $mail = null;
		private $pass = null;
		private $pseudo = null;
		private $pic = null;
		// ... END

		// Constructor ...
		public function __construct ($id = null, $mail = null, $pass = null, $pseudo = null, $pic = null) {
			$this->id = $id;
			$this->mail = $mail;
			$this->pass = $pass;
			$this->pseudo = $pseudo;
			$this->pic = $pic;
		}
		// ... END

		// Setters ...
		public function setId ($id) {
			$this->id = $id;
		}

		public function setMail ($mail) {
			$this->mail = $mail;
		}

		public function setPass ($pass) {
			$this->pass = $pass;
		}

		public function setPseudo ($pseudo) {
			$this->pseudo = $pseudo;
		}

		public function setPic ($pic) {
			$this->pic = $pic;
		}
		// ... END

		// Getters ...
		public function getId () {
			return $this->id;
		}

		public function getMail () {
			return $this->mail;
		}

		public function getPass () {
			return $this->pass;
		}

		public function getPseudo () {
			return $this->pseudo;
		}

		public function getPic () {
			return $this->pic;
		}
		// ... END
	}

?>