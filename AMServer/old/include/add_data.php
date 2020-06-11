<?php
	require 'functions.php';
	/*
	Ïîëó÷àåò GET-çàïðîñ:
		id, time_start, time_end, comment=''
	Âûâîäèò JSON-ïðåäñòàâëåíèå äàííûõ çà çàäàííûé ïåðèîä
	*/
	add_data($_GET['id'], $_GET['time_start'], $_GET['time_end'], $_GET['comment']);
?>