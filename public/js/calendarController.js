// Path initialization
var pathArray = window.location.pathname.split( '/' );
// Calendar tasks
var calendarurl = pathArray[0]+'/restful11/api/index.php/tasks';

//$(document).ready(function() {
//    $('<div/>').append(
//        $('<input/>', {
//            type: 'text',
//            id: 'title',
//            placeholder: 'Title'
//        }),
//        $('<input/>', {
//            type: 'text',
//            id: 'description',
//            placeholder: 'Description'
//        })     
//    );
//});

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
                select: function(start, end) {
                        var title = prompt('Event Title:');
                        var description = prompt('Enter Description:');
                        var eventData;
                        if (title) {
                                eventData = {
                                        title: title,
                                        description: description,
                                        start: start,
                                        end: end
                                };
                                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                        }
                        $('#calendar').fullCalendar('unselect');
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: calendarurl
        });
});