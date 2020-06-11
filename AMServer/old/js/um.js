/*USER-MANAGEMENT*/
function add_user() {
	var name = $('#add_user_form_name').val();
	var phone = $('#add_user_form_phone').val();
	var salary = $('#add_user_form_salary').val();
	$.getJSON(api_php, {action: 'useradd', name: name, phone: phone, salary: salary})
	.done(function (json, textStatus, jqXHR) {
		$('#add_user_form_name').val("");
		$('#add_user_form_phone').val("");
		$('#add_user_form_salary').val("");
        load_users();
    })
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert("Error: "+errorThrown);
    });

	$('#add_user_form').css('display', 'none');
}

function delete_user() {
	$('#delete_user_form').css('display', 'none')
	$.getJSON(api_php, {action: 'userdel', id: selected_id})
	.done(function (json, textStatus, jqXHR) {
        load_users();
    })
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert("Error: "+errorThrown);
    });
}

/*table cell selector*/
function select_cell(uid) {
	selected_id = uid;
	$("tr").css('background-color', 'unset');
	$("#"+uid).css('background-color', '#888');
	$("#delete_user_form_b").removeAttr('disabled');
}

function deselect_all() {
	selected_id = 0;
	$("tr").css('background-color', 'unset');
	$("#delete_user_form_b").attr('disabled', "true");
}

function load_users() {
	deselect_all();
	$("#all_users").html("");
	$.getJSON(api_php, {action: 'get_users'}, function(json, textStatus) {
		$.each(json, function(index, val) {
			$("#all_users").append(
				"<tr id='"+val.id+"'>"+
				"<td onclick=\"select_cell('"+val.id+"')\">"+val.id+"</td>"+
				"<td onclick=\"select_cell('"+val.id+"')\">"+val.name+"</td>"+
				"<td onclick=\"select_cell('"+val.id+"')\">"+val.phone+"</td>"+
				"<td onclick=\"select_cell('"+val.id+"')\">"+val.salary+"</td>"+
				"</tr>"
				);
		});
	});
}