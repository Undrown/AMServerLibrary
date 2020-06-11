<?php
if (!$_GET['action']) {
	die('Hello at AMServer');
}
switch ($_GET['action']) {
	case 'debug':
		include 'test.php';
		break;
	case 'login':
		include 'login.php';
		break;
	case 'useradd':
		include 'useradd.php';
		break;
	case 'userdel':
		include 'userdel.php';
		break;
	case 'add_data':
		include 'add_data.php';
		break;
	case 'get_data':
		include 'get_data.php';
		break;
	case 'get_users':
		include 'get_users.php';
		break;
	default:
		die('ERROR_INVALID_ACTION');
		break;
}
?>