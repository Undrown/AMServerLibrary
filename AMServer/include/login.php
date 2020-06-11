<?php
	require 'functions.php';
	/*
	��������� GET-������:
		phone=123
	������� json-������������� ������ ������������
	["name"="xxx", "phone"="123", ...]
	*/
	//-----���������� �����-----
	if (!$_GET['phone']) {
		die('ERROR_NO_PHONE_PROVIDED');
	}
	$phone = preg_replace("/[\-\+\s]/", '', $_GET['phone']);	//������� �� ������ �������� ������, �����, �������
	if (!is_numeric($phone)) {
		die('ERROR_PHONE_IS_NON_NUMBER');
	}
	login($phone);
?>