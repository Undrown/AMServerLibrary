<?php
require 'functions.php';
	/*
	�������� GET-������:
		id, period_start=0, period_end=datetime_create().getTimestamp()
	������� JSON-������������� ������ �� �������� ������
	*/
	get_data($_GET['id']);
?>