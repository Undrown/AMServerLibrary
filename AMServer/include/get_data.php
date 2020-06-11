<?php
require 'functions.php';
	/*
	Получает GET-запрос:
		id, period_start=0, period_end=datetime_create().getTimestamp()
	Выводит JSON-представление данных за заданный период
	*/
	get_data($_GET['id']);
?>