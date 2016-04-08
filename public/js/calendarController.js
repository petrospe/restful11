// Path initialization
var pathArray = window.location.pathname.split( '/' );
// Calendar tasks
var calendarurl = pathArray[0]+'/restful11/api/index.php/tasks';

$(document).ready(function() {
    $('#taskpopup').append(
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
//                  url: 'javascript:fee_add("' + title + '","' + start +'");',,
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
//                          location.reload();
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
        eventClick: function(calEvent, jsEvent, view) {
            var title = prompt('Event Title:', calEvent.title, { buttons: { Ok: true, Cancel: false} });

          if (title){
              calEvent.title = title;
              calendar.fullCalendar('updateEvent',calEvent);
          }
//            alert('Event: ' + calEvent.title + ' ,DateTime: '+ calEvent.start);
//          alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//          alert('View: ' + view.name);

            // change the border color just for fun
            $(this).css('border-color', 'red');
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: calendarurl
    });
});