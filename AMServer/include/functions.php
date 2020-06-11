<?php
$ok = json_encode("OK");
function get_connection()
{
	$db = new SQLite3('database.db');
	$db->exec("CREATE TABLE IF NOT EXISTS users (id UINQUE, phone UNIQUE, name UNIQUE, salary)");
	return $db;
}

function login($phone)
{
	$db = get_connection();
	$result = $db->query("SELECT id,phone,name,salary FROM users WHERE phone='$phone'");
	if ($result->numColumns() < 4) {
		die('ERROR_USER_NOT_FOUND');
	}
	$data = $result->fetchArray(SQLITE3_ASSOC);
	if(!$data['id'])die("ERROR_USER_NOT_FOUND");
	$user = new stdClass();
	$user->id = $data["id"];
	$user->phone = $data["phone"];
	$user->name = utf8_encode($data["name"]);
	$user->salary = $data["salary"];
	die(json_encode($user, JSON_INVALID_UTF8_SUBSTITUTE ));
}

function useradd($phone, $name, $salary)
{
	$db = get_connection();
	$id = uniqid();
	$result = $db->exec("INSERT INTO users (id, phone, name, salary) VALUES ('$id','$phone','$name','$salary')");
	if ($db->lastErrorCode() == 19) {
		die("ERROR_NON_UNIQUE");
	}
	if (!$result) {
		die("ERROR_OTHER");
	}
	$result = $db->exec("CREATE TABLE IF NOT EXISTS data_$id(timeAdd, timeStart, timeEnd, comment)");
	if(!$result) die('ERROR_OTHER');
	die($ok);
}

function userdel($id)
{
	$db = get_connection();
	$result = $db->exec("DELETE FROM users WHERE id='$id'");
	if ($result) {
		die($ok);
	}else{
		die("ERROR_OTHER");
	}
}

function get_data($id, $period_start=0, $period_end=0){
	if ($period_end == 0) $period_end = date_create()->getTimestamp();
	$db = get_connection();
	$result = $db->query(
	    "SELECT *FROM data_$id"
	    );
	$data = array();
	while ($line = $result->fetchArray(SQLITE3_ASSOC)) {
		array_push($data, $line);
	}
	die(json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE ));
}

function add_data($id, $timeStart, $timeEnd, $comment)
{
	$db = get_connection();
	$user = $db->query("SELECT name FROM users WHERE id='$id'")->fetchArray();
	if (!$user)return("ERROR_NO_SUCH_USER");
	$time_add = date_create()->getTimestamp();
	if (!$comment) $comment = " ";
	$result = $db->exec("INSERT INTO data_$id 
		(timeAdd, timeStart, timeEnd, comment)
		VALUES 
		('$time_add', '$timeStart', '$timeEnd', '$comment')");
	if (!$result)die('ERROR_OTHER');
	die("OK");
}

function update_entry($timeAdd, $timeStart, $timeEnd, $comment)
{
    $db = get_connection();
    $user = $db->query("SELECT name FROM users WHERE id='$id'")->fetchArray();
    if (!$user)return("ERROR_NO_SUCH_USER");
    $result = $db->exec("UPDATE data_$id
        SET timeStart='$timeStart',
            timeEnd='$timeEnd',
            comment='$comment'
        WHERE timeAdd='$timeAdd'");
}
//-------------------not-ready--------------------

function show_errors()
{
	$db = get_connection();
	return("<br>Last error code: ".$db->lastErrorCode());
}
?>