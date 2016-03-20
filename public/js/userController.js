// Delete user
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
// Users grid
var url = 'http://localhost/restful11/api/index.php/users';
$.ajax({
    url: url,
    type: 'GET',
    success: function (response) {
        var trHTML = '';
        $.each(response, function (i, item) {
            function statuslabel(){if (item.status == 1){ return 'Enabled';} else { return 'Disabled';}}
            trHTML += '<tr id='+item.id+'><td>' + item.id + '</td><td><a href="#" class="editdata" id="fname">' + item.fname + '</a></td><td><a href="#" class="editdata" id="lname">' + item.lname + '</a></td><td><a href="#" class="editdata" id="title">' + item.title + '</a></td><td><a href="#" class="editdata" id="username">' + item.username + '</a></td><td><a href="#" class="editdata" id="password">' + item.password + '</a></td><td><a href="#" class="editdata" id="email">' + item.email + '</a></td><td><a href="#" class="selectstatus" id="status" data-type="select">' + statuslabel() + '</a></td><td><button type="button" class="btn btn-danger" onclick="DeleteUser('+item.id+')">Delete</button></td></tr>';
        });
        $('#userstable').append(trHTML);

        //Edit users fields
        //$.fn.editable.defaults.mode = 'popup';
        $('.editdata').editable();
        $('.selectstatus').editable({
            source: [
                {value: 0, text: 'Disabled'},
                {value: 1, text: 'Enabled'}
           ]
        });
        $(document).on('click','.editable-submit',function(){
            var x = $(this).closest('tr').attr('id');
            var y = $(this).closest('td').children('a').attr('id');
            var z = $('.input-sm').val();
            var p = {};
            p[y] = z;
            var w = JSON.stringify(p);
            $.ajax({
                url: 'http://localhost/restful11/api/index.php/user/'+x+'/'+w,
                type: 'put',
            });
        });
    }
});
// Insert users
$(document).ready(function(){
    $('#usersubmit').click(function(){
        var fname = $('#insfname').val();
        var lname = $('#inslname').val();
        var title = $('#institle').val();
        var username = $('#insusername').val();
        var password = $('#inspassword').val();
        var email = $('#insemail').val();
        var status;
        if ($('#insstatus').prop('checked')){
            status= '1';
        }else{
            status= '0';
        }
	//var status = $("#status").val();
	if(username=='' && email==''){
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