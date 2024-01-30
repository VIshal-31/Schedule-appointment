@extends('components.dlayout')

@section('title1', 'Calendar')

@section('dslot')

<div class="col-md-9" id="calendar"></div>
<p id="eventDetails"></p>


<script>
    $(document).ready(function () {
        // Initialize FullCalendar with events
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: function (start, end, timezone, callback) {
                // Fetch events from your server
                $.ajax({
                    url: '/dashboard/calendar/getevent',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        var events = response.map(function (event) {
                            // Concatenate date and time strings to create valid date-time format
                            var startDateTime = event.date + 'T' + event.service_start_time;
                            var endDateTime = event.date + 'T' + event.service_end_time;

                            return {
                                title: event.name,
                                start: startDateTime,
                                end: endDateTime,
                                status: event.Status,
                                service: event.service_name,
                                id: event.id,
                                category: event.category,
                                email: event.email,
                                // Add other properties as needed
                            };
                        });

                        callback(events);
                    },
                    error: function () {
                        alert('Error fetching events');
                    }
                });
            },
            eventRender: function (event, element) {
                // Customize event rendering based on status
                if (event.status === 'New') {
                    element.css('background-color', 'blue');
                } else if (event.status === 'Confirm') {
                    element.css('background-color', 'green');
                } else if (event.status === 'Canceled') {
                    element.css('background-color', 'red');
                }

                // Display additional data in the tooltip
                var tooltipText = 'Service: ' + event.service + '<br>Status: ' + event.status
                + '<br>Email: ' + event.email+ '<br>Category: ' + event.category + '<br>Service: ' + event.service;
                element.tooltip({
                    title: tooltipText,
                    container: 'body',
                    html: true,
                });
            },
            eventClick: function (event) {
                // Redirect to the edit page with the event id
                if (event.id) {
                    window.location.href = '/dashboard/enquire/edit/' + event.id;
                } else {
                    console.error('Event ID is undefined or not present in the event object.');
                }
            }
        });
    });
</script>




@endsection