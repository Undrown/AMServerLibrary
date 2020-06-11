/*	Data-management
*/

function load_data() {
    $("#all_data").html("");
	$.getJSON(api_php, {action: 'get_data', id: uid})
	.done(function (json, textStatus, jqXHR) {
		$.each(json, function(index, val) {
			let date = new Date(val.timeAdd * 1000);
			 $("#all_data").append(
				"<tr id='"+val.timeAdd+"'>"+
				"<td onclick=\"select_cell('"+val.timeAdd+"')\">"+date+"</td>"+
				"<td onclick=\"select_cell('"+val.timeAdd+"')\">"+uid+"</td>"+
				"<td onclick=\"select_cell('"+val.timeAdd+"')\">"+val.timeStart+"</td>"+
				"<td onclick=\"select_cell('"+val.timeAdd+"')\">"+val.timeEnd+"</td>"+
				"<td onclick=\"select_cell('"+val.timeAdd+"')\">"+val.comment+"</td>"+
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
	$.getJSON(api_php, {action: 'add_data', id: uid, timeStart: time_start, timeEnd: time_end, comment: comment})
	.done(function (json, textStatus, jqXHR) {
		alert(json);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert("Error: "+errorThrown);
    });
}