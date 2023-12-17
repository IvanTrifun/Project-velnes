$(document).ready(function(){

    // console.log(booking)
    $('#calendar').fullCalendar({
        header: {
            left:'prev, next, today',
            center: 'title',
            right:'month, agendaWeek, agendaDay'
        },
        events : booking,
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDays){
            var currentView = $('#calendar').fullCalendar('getView').type
            
            if (currentView === 'agendaDay'){
                $('#start_time').val(moment(start).format('YYYY-MM-DD HH:mm:ss'))
                $('#end_time').val(moment(end).format('YYYY-MM-DD HH:mm:ss'))
                $('#appointment').modal('toggle')
            }

        },
        dayClick: function(date, jsEvent, view) {
            // Display daily agenda for the clicked day
            $('#calendar').fullCalendar('changeView', 'agendaDay');
            $('#calendar').fullCalendar('gotoDate', date);
        }
    })
});
