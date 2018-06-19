// Path initialization
var pathArray = window.location.pathname.split( '/' );
// Delete user
function DeleteProject(d) {
    //confirm('Delete '+d+' ?')
    var deleteurl = pathArray[0]+'/'+pathArray[1]+'/api/index.php/project/'+d;
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
// Project card
var cardurl = pathArray[0]+'/'+pathArray[1]+'/api/index.php/projects';
var imagepathurl = pathArray[0]+'/'+pathArray[1]+'/public/images/projects/';
// Modal Window
$(document).ready(function() {
    $('#projectdialog').append(
        $('<div/>').append(
            $('<form/>').append(
                $('<div/>').append(
                    $('<div/>').append(
                        $('<h4/>').append('Edit Project')
                    ).addClass('modal-header'),
                    $('<div/>').append(
                        $('<label/>').append('User'),
                        $('<input/>', {
                            type: 'text',
                            id: 'user',
                            disabled: 'disabled'
                        }).addClass('form-control'),
                        $('<label/>').append('Title'),
                        $('<input/>', {
                            type: 'text',
                            id: 'title',
                            placeholder: 'Title'
                        }).addClass('form-control'),
                        $('<label/>').append('Description'),
                        $('<textarea/>', {
                            row: '4',
                            cols: '50',
                            id: 'description',
                            placeholder: 'Description'
                        }).addClass('form-control'),
                        $('<label/>').append('Image'),
                        $('<select/>', {
                            id: 'image'
                        }).addClass('form-control'),
                        $('<label/>').append('Create Date'),
                        $('<input/>', {
                            type: 'text',
                            id: 'createdate',
                            disabled: 'disabled'
                        }).addClass('form-control'),
                        $('<label/>').append('Modification Date'),
                        $('<input/>', {
                            type: 'text',
                            id: 'modificationdate',
                            disabled: 'disabled'
                        }).addClass('form-control')
                    ).addClass('modal-body'),
                    $('<div/>').append(
                        $('<button/>', {
                            type: 'submit',
                            id: 'close',
                            text: 'Close'
                        }).addClass('btn btn-default'),
                        $('<button/>', {
                            type: 'submit',
                            id: 'save',
                            text: 'Save'
                        }).addClass('btn btn-success'),
                        $('<button/>', {
                            type: 'submit',
                            id: 'delete',
                            text: 'Delete'
                        }).addClass('btn btn-danger')
                    ).addClass('modal-footer')
                ).addClass('modal-content')
            ).addClass('project-modal-form')
        ).addClass('modal-dialog')
    ).addClass('modal fade')
});
$.ajax({
    url: cardurl,
    type: 'GET',
    success: function (response) {
        var divHTML = '';
        $.each(response, function (i, item) {
            divHTML += '<div class="col-xs-18 col-sm-6 col-md-4"><div class="thumbnail"><img src="' + imagepathurl + item.image + '" name="image" class="img-responsive img-rounded"> <div class="caption"><h4 class="title" name="title">' + item.title + '</h4> <p class="more" name="description">' + item.description + '</p><a id='+item.id+' class="btn btn-default btn-xs pull-right edit-project" role="button"><i class="glyphicon glyphicon-edit"></i></a><a class="btn btn-info btn-xs" role="button">Tasks</a></div></div></div>';
        });
        $('#projectcards').append(divHTML);
        $('.more').readmore({
            speed: 300,
            collapsedHeight: 40,
            moreLink: '<span class="text-center glyphicon glyphicon-menu-down"></span>',
            lessLink: '<span class="text-center glyphicon glyphicon-menu-up"></span>'
        });
    },
    error:function(){
        alert("Something went wrong");
    },
    complete: function(){
        $('#projectadd').append(
            $('<a>',{
                href: '#'
            }).prepend(
                $('<img>',{
                    src:'images/add_circle_grey_192x192.png'
                }).addClass('img-responsive center-block')
        )).addClass('col-xs-18 col-sm-6 col-md-4');
    }
});
// Edit project
$(document).on('click','.edit-project',function(){
    var x = $(this).closest('a').attr('id');
    $.ajax({
        url: pathArray[0]+'/'+pathArray[1]+'/api/index.php/project/'+x,
        type: 'GET',
        dataType: "json",
        success: function (response){
            $('#projectdialog').modal(
                $("#user").val(response.user),
                $("#title").val(response.title),
                $("#description").val(response.description),
                $("#image").val(response.image),
                $("#createdate").val(response.createdate),
                $("#modificationdate").val(response.modificationdate),
                $('#close').click(function(){
                    $('#projectdialog').modal('hide');
                }),
                $('#save').click(function(){
                    var dt = new Date($.now());
                    var projectupdate = {
                         title:$('#title').val(),
                         description:$('#description').val(),
                         image:$('#image').val(),
                         modificationdate:dt
                     };
                     var w = JSON.stringify(projectupdate);
                     var updateurl = pathArray[0]+'/'+pathArray[1]+'/api/index.php/project/'+x+'/'+w;
                     $.ajax({
                         url: updateurl,
                         type: 'put',
                         async: false,
                         success:function(data){
                             $('#projectdialog').modal('hide');
                             location.reload();
                         },
                         error:function(){
                             alert("Something went wrong");
                         }
                     });
                }),
                // Delete Project
                $('#delete').click(function(){
                    var deleteurl = pathArray[0]+'/'+pathArray[1]+'/api/index.php/project/'+x;
                    $.ajax({
                        url: deleteurl,
                        type: 'DELETE',
                        async: false,
                        success:function(data){
                            $('#projectdialog').modal('hide');
                            location.reload();
                        },
                        error:function(){
                            alert("Something went wrong");
                        }
                    });
                })
            );
        },
        error:function(){
            alert("Something went wrong");
        }
    });
});

$(document).ready(function() {
    $.ajax({
        url: pathArray[0]+'/'+pathArray[1]+'/api/index.php/images',
        type: 'GET',
        dataType: "json",
        success : function (data){
            $.each(data, function (key, value) {
                $("#image").append($('<option>', {
                    value: value,
                    text: value
                }));
            })
        },
        error:function(){
            alert("Something went wrong");
        }
    });
});
$(document).on('click','#projectadd',function(){
    $('#projectdialog').modal(
        $('.project-modal-form')[0].reset()
    );
});