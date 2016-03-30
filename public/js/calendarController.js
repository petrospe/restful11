// Path initialization
var pathArray = window.location.pathname.split( '/' );
// Calendar tasks
var calendarurl = pathArray[0]+'/restful11/api/index.php/tasks';

$(document).ready(function() {
    $('#taskinsert').append(
        $('<div/>').append(
            $('<input/>', {
                type: 'text',
                id: 'title',
                placeholder: 'Title'
            }),
            $('<input/>', {
                type: 'text',
                id: 'description',
                placeholder: 'Description'
            }),
            $('<input/>', {
                type: 'text',
                id: 'start',
                placeholder: 'Start datetime'
            }),
            $('<input/>', {
                type: 'text',
                id: 'end',
                placeholder: 'End datetime'
            }),
            $('<button/>', {
                        type: 'submit',
                        text: 'Submit'
            }).addClass('btn btn-primary')
        )
    )
});

$(document).ready(function() {

        $('#calendar').fullCalendar({
                header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: Date(),
                selectable: true,
                selectHelper: true,
//                select: function(start, end){
//                    $('#taskinsert').show(); // show's pop up
//                    $('input').focus(); // auto focus on the field
//                    var start = Date.parse(start) / 1000; // parse the start time to retain value
//                    var end = Date.parse(end) / 1000; // same but with end
//                    $('.btn btn-primary').click(function(){ // on submission
//                        var title = $('#title').val(); // gets title value
//                        if(title){ // if the title exists run script
//                            $.post(pathArray[0]+'/restful11/api/index.php/task', {title: title, start:start, end: end, allDay: allDay}, // be sure to filter data 
//                            function(){
//                            $('#title').val(''); // clear title field
//                            start = ''; // clear start time
//                            end = ''; // clear end time
//                            calendar.fullCalendar('unselect');
//                            calendar.fullCalendar('refetchEvents');
//                            });
//                        }
//                    $('#taskinsert').hide(); // hide pop up box
//                    });
//                },
                select: function(start, end) {
                        var title = prompt('Event Title:');
//                        var description = prompt('Enter Description:');
                        var eventData;
                        if (title) {
                                eventData = {
                                        title: title,
//                                        description: description,
//                                        url: 'javascript:fee_add("' + title + '","' + start +'");',,
//                                        start: new Date(),
//                                        end: new Date()
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
//                                $.post(pathArray[0]+'/restful11/api/index.php/task'),
                                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                        }
                        
                        $('#calendar').fullCalendar('unselect');
                },
                
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: calendarurl
                
        });
});