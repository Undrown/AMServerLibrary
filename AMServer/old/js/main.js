//GLOBALS
var api_php='include/api.php';
var selected_id=0;
var uid=0;
var phone=0;

function hide_all(){
	$(".actions").css('display', 'none');
	$(".result_table").css('display', 'none');
	$("#result").html("");
}

function toggle_user_management() {
	hide_all();
	$("#um").css('display', 'block');
	$("#result_um").css('display', 'block');
	load_users();
}

function toggle_data_management() {
	hide_all();
	$(".actions").css('display', 'none');
	$("#result_data").css('display', 'block');
	load_data();
}