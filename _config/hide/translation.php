<?php 
	
	namespace Project\_config\hide;

	class Translation {

		private $default = "en";

		public function __construct () {
			
		}

		public function translate($word){
			$lang = $this->getCurLang();
			if($lang != $this->default){
				$dictionnary = $this->getLangWords($lang);
				if(!$dictionnary == null && sizeof($dictionnary) > 0){
					if(array_key_exists($word, $dictionnary)){
						return $dictionnary[$word];
					}
				}
			}
			return $word;
		}

		private function getCurLang(){
			return isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2) : "en";
		}

		private function getLangWords($lang){
			$folds = scandir("Translations");
			if(in_array($lang, $folds)){
				$files = scandir("Translations/" . $lang);
				$res = [];
				foreach ($files as $f) {
					if($f != "." && $f != ".."){
						$file = fopen("Translations/" . $lang . "/" . $f, "r");
						while(!feof($file)){							
							$entry = explode(" : ", fgets($file));
							//print_r($entry) . "<br>";
							$res[$entry[0]] = $entry[1];
						}
						fclose($file);	
					}
				}
				return $res;
			}else{
				return null;
			}
		}
	}

?>