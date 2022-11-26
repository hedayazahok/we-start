<!DOCTYPE html>
<html>
<head>
    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body>

<div class="container">
    <h1>Laravel 9 FullCalender Tutorial Example - ItSolutionStuff.com</h1>
    <div id='calendar'></div>
</div>

<script type="text/javascript">

$(document).ready(function () {


    $('#calendar').fullCalendar({
    // events: 'calendar',
    eventColor: '#378006',
    displayEventTime: false,
    eventSources: [
        {
            events: function(start, end, timezone, callback ){
                $.ajax({
                    url: "{{route('admin.chalet.fullcalender',$chalet->id)}}",
                    type: 'GET',

                      dataType: 'json',
                    success: function(res) {
                        console.log(res);

                        var events = [];



                        for (var i = 0; i < res.length; i++){
                            console.log(res[0].name);
                            events.push({
                                title: res[0].name,
                                start: res[0].arrival_date,
                                end: res[0].departure_date
                            });
                        }
                        callback(events);
                    },
                });
            },
            color: 'darkblue',   // an option!
            textColor: 'white', // an option!
        }
    ],
    eventRender: function (event, element, view) {
        if (event.allDay === 'true') {
                event.allDay = true;
        } else {
                event.allDay = false;
        }
    },
    selectable: true,
    selectHelper: true,
});
});



</script>

</body>
</html>
