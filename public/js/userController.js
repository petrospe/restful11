var pathArray = window.location.pathname.split( '/' );
// Delete user
function DeleteUser(d) {
    //confirm('Delete '+d+' ?')
    var deleteurl = pathArray[0]+'/restful11/api/index.php/user/'+d;
    $.ajax({
        url: deleteurl,
        type: 'DELETE',
        async: false,
        success:function(data){
            alert('Deleted '+d+'');
            $('#'+d).remove();
            }
	});
}
// Users grid
var gridurl = pathArray[0]+'/restful11/api/index.php/users';
$.ajax({
    url: gridurl,
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
                url: pathArray[0]+'/restful11/api/index.php/user/'+x+'/'+w,
                type: 'put'
            });
        });
    }
});
// Insert users
$(document).ready(function() {
    $('thead#userstablethead').append(
    // Creating <thead> <th> tag with labels.
        $('<tr/>').append(
            $('<th/>').text('ID'),
            $('<th/>').text('First Name'),
            $('<th/>').text('Last Name'),
            $('<th/>').text('Title'),
            $('<th/>', {
                    colspan:'2',
                    text: 'Username'
            }),
            $('<th/>').text('Email'),
            $('<th/>').text('Status'),
            $('<th/>').text('Action')
        ),/* End of Label */
        $('<tr/>').append(
        // Create <th> Tag and Appending in HTML form.
            $('<th/>').append(
                $('<input/>', {
                        type: 'hidden',
                        name: '_METHOD',
                        value: 'PUT'
                })
            ),
            $('<th/>').append(
                $('<input/>', {
                        type: 'text',
                        id: 'insfname',
                        name: 'insfname',
                        placeholder: 'Name'
                }).addClass('form-control')
            ),
            $('<th/>').append(
                $('<input/>', {
                        type: 'text',
                        id: 'inslname',
                        name: 'inslname',
                        placeholder: 'Last name'
                }).addClass('form-control')
            ),
            $('<th/>').append(
                $('<input/>', {
                        type: 'text',
                        id: 'institle',
                        name: 'institle',
                        placeholder: 'Title'
                }).addClass('form-control')
            ),
            $('<th/>').append(
                $('<input/>', {
                        type: 'text',
                        id: 'insusername',
                        name: 'insusername',
                        placeholder: 'User name'
                }).addClass('form-control')
            ),
            $('<th/>').append(
                $('<input/>', {
                        type: 'password',
                        id: 'inspassword',
                        name: 'inspassword',
                        placeholder: 'Password'
                }).addClass('form-control')
            ),
            $('<th/>').append(
                $('<input/>', {
                        type: 'text',
                        id: 'insemail',
                        name: 'insemail',
                        placeholder: 'email'
                }).addClass('form-control')
            ),
            $('<th/>').append(
                $('<input/>', {
                        type: 'checkbox',
                        id: 'insstatus',
                        name: 'insstatus'
                }).addClass('form-control')
            ),
            $('<th/>').append(
                $('<button/>', {
                        type: 'submit',
                        id: 'usersubmit',
                        name: 'usersubmit',
                        onclick: 'UserInsertSubmit()',
                        text: 'Insert'
                }).addClass('btn btn-primary')
            )
        ) /* End of Input Form */
    );
});
function UserInsertSubmit() {
    var inserturl = pathArray[0]+'/restful11/api/index.php/user';
    if ($('#insstatus').prop('checked')){
        var status= '1';
    }else{
        var status= '0';
    }
    if($('#insusername').val()=='' && $('#insemail').val()==''){
        alert('Please fill out the form');
    }
    else if($('#insusername').val()=='' && $('#insemail').val()!==''){alert('Username field is required');}
    else if($('#insemail').val()=='' && $('#insusername').val()!==''){alert('Email field is required');}
    else{
        var userinsert = {
            fname:$('#insfname').val(),
            lname:$('#inslname').val(),
            title:$('#institle').val(),
            username:$('#insusername').val(),
            password:$('#inspassword').val(),
            email:$('#insemail').val(),
            status:status
        };
        $.ajax({
            url: inserturl,
            type: 'POST',
            async: false,
            data: userinsert,
            datatype: 'json',
            success:function(msg){
                if(msg){
                    alert('User '+$('#insusername').val()+' was added');
                    location.reload();
                }else{
                    alert('User cannot added');
                }
            }
        });
    }
}