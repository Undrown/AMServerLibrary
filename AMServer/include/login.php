<?php
	require 'functions.php';
	/*
	Принимает GET-запрос:
		phone=123
	Выводит json-представление данных пользователя
	["name"="xxx", "phone"="123", ...]
	*/
	//-----фильтрация ввода-----
	if (!$_GET['phone']) {
		die('ERROR_NO_PHONE_PROVIDED');
	}
	$phone = preg_replace("/[\-\+\s]/", '', $_GET['phone']);	//убираем из номера телефона минусы, плюсы, пробелы
	if (!is_numeric($phone)) {
		die('ERROR_PHONE_IS_NON_NUMBER');
	}
	login($phone);
?>