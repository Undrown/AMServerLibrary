<?php
	require 'functions.php';
	/*
	��������� GET-������:
		name=...&phone=...&salary=...
	������� "OK" ��� ������, ����� ������
	* ��� ������ ���������� � ������� ��������
	*/
	//-----���������� �����-----
	if (!$_GET['phone']) {
		die('ERROR_NO_PHONE_PROVIDED');
	}
	if (!$_GET['name']) {
		die('ERROR_NO_NAME_PROVIDED');
	}
	if (!$_GET['salary']) {
		die('ERROR_NO_SALARY_PROVIDED');
	}
	$phone = preg_replace("/[\-\+\s]/", '', $_GET['phone']);	//������� �� �������� ������, �����, �������
	$name = strtolower($_GET['name']);
	if (!is_numeric($phone)) {
		die('ERROR_PHONE_IS_NON_NUMBER');
	}
	if (!is_numeric($_GET['salary'])) {
		die('ERROR_SALARY_IS_NON_NUMBER');
	}
	useradd($phone, $name, $_GET['salary']);
?>