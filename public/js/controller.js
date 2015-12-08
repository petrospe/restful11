
function DeleteUser(d) {
	//confirm('Delete '+d+' ?')
	var _url = 'http://localhost/restful11/api/index.php/user/'+d;
	$.ajax({
		url: _url,
		type: 'DELETE',
		async: false,
		success:function(data){
alert('Deleted '+d+'');
$('#'+d).remove();
		},	
	})
}

var url = 'http://localhost/restful11/api/index.php/users';
$.ajax({
    url: url,
    type: 'GET',
    success: function (response) {
        var trHTML = '';
        $.each(response, function (i, item) {
        	function statuslabel(){if (item.status == 1){ return 'Enabled';} else { return 'Disabled';}}
            trHTML += '<tr id='+item.id+'><td>' + item.id + '</td><td>' + item.fname + '</td><td>' + item.lname + '</td><td>' + item.title + '</td><td colspan="2">' + item.username + '</td><td>' + item.email + '</td><td>' + statuslabel() + '</td><td><button type="button" class="btn btn-warning">Edit</button></td><td><button type="button" class="btn btn-danger" onclick="DeleteUser('+item.id+')">Delete</button></td></tr>';
        });
        $('#userstable').append(trHTML);
    }
});

$(document).ready(function(){
	$('#usersubmit').click(function(){
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var title = $('#title').val();
	var username = $('#username').val();
	var password = $('#password').val();
	var email = $('#email').val();
	var status;
		if ($('#status').prop('checked')){
		    status= '1';
		}else{
		    status= '0';
		}
	//var status = $("#status").val();
	if(username=='' && email=='')
		{
		alert('Please fill out the form');
		}
	else if(username=='' && email!==''){alert('Username field is required')}
	else if(email=='' && username!==''){alert('Email field is required')}
	else{
		$.post('http://localhost/restful11/api/index.php/user', //Required URL of the page on server
{ // Data Sending With Request To Server
fname:fname,
lname:lname,
title:title,
username:username,
password:password,
email:email,
status:status
},
		function(response,status){ // Required Callback Function
alert('*----Received Data----*\n\nResponse : ' + response+'\n\nStatus : ' + status);//"response" receives - whatever written in echo of above PHP script.
$('#insertuser')[0].reset();
		});
		}
	});
});
