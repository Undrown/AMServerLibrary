<?php
	require 'functions.php';
	/*
	Принимает GET-запрос:
		name=...&phone=...&salary=...
	Выводит "OK" при успехе, иначе ошибку
	* Все строки приводятся к нижнему регистру
	*/
	//-----фильтрация ввода-----
	if (!$_GET['phone']) {
		die('ERROR_NO_PHONE_PROVIDED');
	}
	if (!$_GET['name']) {
		die('ERROR_NO_NAME_PROVIDED');
	}
	if (!$_GET['salary']) {
		die('ERROR_NO_SALARY_PROVIDED');
	}
	$phone = preg_replace("/[\-\+\s]/", '', $_GET['phone']);	//убираем из телефона минусы, плюсы, пробелы
	$name = strtolower($_GET['name']);
	if (!is_numeric($phone)) {
		die('ERROR_PHONE_IS_NON_NUMBER');
	}
	if (!is_numeric($_GET['salary'])) {
		die('ERROR_SALARY_IS_NON_NUMBER');
	}
	useradd($phone, $name, $_GET['salary']);
?>