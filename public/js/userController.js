// Delete user
function DeleteUser(d) {
    //confirm('Delete '+d+' ?')
    var deleteurl = 'http://localhost/restful11/api/index.php/user/'+d;
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
var gridurl = 'http://localhost/restful11/api/index.php/users';
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
                url: 'http://localhost/restful11/api/index.php/user/'+x+'/'+w,
                type: 'put'
            });
        });
    }
});
// Insert users
function UserInsertSubmit() {
    var inserturl = 'http://localhost/restful11/api/index.php/user';
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
                }else{
                    alert('User cannot added');
                }
            }
        });
    }
}