// Path initialization
var pathArray = window.location.pathname.split( '/' );
// Calendar tasks
var calendarurl = pathArray[0]+'/restful11/api/index.php/tasks';

$(document).ready(function() {
    $('#taskdialog').append(
        $('<div/>').append(
            $('<div/>').append(
                $('<div/>').append(
                    $('<h4/>').append('Edit Task')
                ).addClass('modal-header'),
                $('<div/>').append(
                    $('<label/>').append('Title'),
                    $('<input/>', {
                        type: 'text',
                        id: 'title',
                        placeholder: 'Title'
                    }).addClass('form-control'),
                    $('<label/>').append('Description'),
                    $('<input/>', {
                        type: 'text',
                        id: 'description',
                        placeholder: 'Description'
                    }).addClass('form-control'),
                    $('<label/>').append('Start Datetime'),
                    $('<input/>', {
                        type: 'text',
                        id: 'start',
                        placeholder: 'Start datetime'
                    }).addClass('form-control'),
                    $('<label/>').append('End Datetime'),
                    $('<input/>', {
                        type: 'text',
                        id: 'end',
                        placeholder: 'End datetime'
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
        ).addClass('modal-dialog')
    ).addClass('modal fade')
});

$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        defaultDate: new Date(),
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            var title = prompt('Event Title:');
            var start=moment(start).format('YYYY-MM-DD HH:mm:ss');
            var end=moment(end).format('YYYY-MM-DD HH:mm:ss');
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
//                  allDay : false
                };
                $.ajax({
                    url: pathArray[0]+'/restful11/api/index.php/task',
                    type: 'POST',
                    async: false,
                    data: eventData,
                    datatype: 'json',
                    success:function(msg){
                        if(msg){
                            alert('Task was added');
                            location.reload();
                        }else{
                            alert('Task cannot added');
                        }
                    }
                }),
//              $.post(pathArray[0]+'/restful11/api/index.php/task'),
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendar').fullCalendar('unselect');
        },
// Update task and delete
        eventClick: function(calEvent, jsEvent, view) {
            $('#title').val(calEvent.title);
            $('#description').val(calEvent.description);
            $('#start').val((calEvent.start).format('YYYY-MM-DD HH:mm:ss'));
            $('#end').val((calEvent.end).format('YYYY-MM-DD HH:mm:ss'));
            $('#close').click(function(){
                $('#taskdialog').modal('hide')
            }),
            $('#save').click(function(){
               var taskupdate = {
                    title:$('#title').val(),
                    description:$('#description').val(),
                    start:$('#start').val(),
                    end:$('#end').val()
                };
                var w = JSON.stringify(taskupdate);
                var d = calEvent.id;
                var updateurl = pathArray[0]+'/restful11/api/index.php/task/'+d+'/'+w;
                $.ajax({
                    url: updateurl,
                    type: 'put',
                    async: false,
                    success:function(data){
                        location.reload();
                    }
                });
            }),
            $('#delete').click(function(){
                var d = calEvent.id;
                var deleteurl = pathArray[0]+'/restful11/api/index.php/task/'+d;
                $.ajax({
                    url: deleteurl,
                    type: 'DELETE',
                    async: false,
                    success:function(data){
                        $('#calendar').fullCalendar('removeEvents', +d);
                        $('#taskdialog').modal('hide');
                    }
                });
            });
            $('#taskdialog').modal();
            $(this).css('border-color', 'red');
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
// Get Tasks
        events: calendarurl
    });
});