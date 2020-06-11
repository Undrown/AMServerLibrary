/*	Data-management
*/

function load_data() {
    $("#all_data").html("");
	$.getJSON(api_php, {action: 'get_data', id: uid})
	.done(function (json, textStatus, jqXHR) {
		$.each(json, function(index, val) {
			let date = new Date(val.time_add * 1000);
			 $("#all_data").append(
				"<tr id='"+val.time_add+"'>"+
				"<td onclick=\"select_cell('"+val.time_add+"')\">"+date+"</td>"+
				"<td onclick=\"select_cell('"+val.time_add+"')\">"+uid+"</td>"+
				"<td onclick=\"select_cell('"+val.time_add+"')\">"+val.time_start+"</td>"+
				"<td onclick=\"select_cell('"+val.time_add+"')\">"+val.time_end+"</td>"+
				"<td onclick=\"select_cell('"+val.time_add+"')\">"+val.comment+"</td>"+
				"</tr>"
				);
		});
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert("Error: "+errorThrown);
    });
}

function add_data() {
	var time_start=$('#add_data_form_time_start').val();
	var time_end=$('#add_data_form_time_end').val();
	var comment=$('#add_data_form_comment').val();
	$.getJSON(api_php, {action: 'add_data', id: uid, time_start: time_start, time_end: time_end, comment: comment})
	.done(function (json, textStatus, jqXHR) {
		alert(json);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert("Error: "+errorThrown);
    });
}