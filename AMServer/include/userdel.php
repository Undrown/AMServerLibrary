<?php
require 'functions.php';
	/*
	Принимает GET-запрос:
		id=xxx
	* Все строки приводятся к нижнему регистру
	*/
	if (!$_GET['id']) {
		die("ERROR_NO_ID_PROVIDED");
	}
	userdel($_GET['id']);
?>