<?php
	session_start();
	ini_set("display_errors", 1);	
	function loadKeywords() {		
		$keywords = json_decode(file_get_contents("config.json"), true);
		return $keywords;
	}

	function getParam($code) {
		if (isset($_GET[$code])) {
			return $_GET[$code];
		}
		return null;
	}


	function hasBeenDone($code) {
		if (isset($_SESSION["done"][$code])) {
			return true;
		} else {
			return false;
		}
	}

	function doCode($code) {
		if (!isset($_SESSION["done"])) {
			$_SESSION["done"] = [];
		}
		$_SESSION["done"][$code] = 1;
	}


?>