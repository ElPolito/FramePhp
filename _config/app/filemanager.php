<?php 

	namespace Project\_config\app;

	class FileManager {

		public static function createFile ($path) {
			return fopen($path, "w");
		}

		public static function fileExists ($path) {
			return file_exists($path);
		}

		public static function openFile ($path) {
			return fopen($path, "w");	
		}

	}



?>