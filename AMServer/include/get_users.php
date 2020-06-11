<?php
require 'functions.php';
	/*
	¬ыводит JSON-представление всех пользователей
	*/
	$db = get_connection();
	$result = $db->query("SELECT * FROM users");
	$data = array();
	while ($line = $result->fetchArray(SQLITE3_ASSOC)) {
		array_push($data, $line);
	}
	die(json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE|JSON_FORCE_OBJECT ));
?>