<?php
require 'functions.php';
	/*
	��������� GET-������:
		id=xxx
	* ��� ������ ���������� � ������� ��������
	*/
	if (!$_GET['id']) {
		die("ERROR_NO_ID_PROVIDED");
	}
	userdel($_GET['id']);
?>