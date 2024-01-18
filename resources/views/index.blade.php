@extends('components.layout')

@section('title', 'Home')

@section('slot')


<div class="container my-4">
  <div class="d-flex align-items-center justify-content-center m-4"><h1><b>{{ $shop->name }}</b></h1></div>
  <hr>
  <div class="row my-4"><h3 class="col">Book Your Appoitment Now</h3><h4>Opening Time : {{ $shop->opening_time }} - Closing Time : {{ $shop->closing_time }}</h4></div>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form action="{{ route('submit.form') }}" method="POST">
    <!-- Form fields -->
    @csrf
    <div class="form-group">
      <label for="name"><b>Name:</b></label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
    </div>
    <div class="form-group">
      <label for="email"><b>Email:</b></label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
    </div>
    <div class="form-group">
      <label for="category"><b>Category:</b></label>
      <select class="form-control" id="category" name="category">
        <option value="">Please Select Category</option>
        @foreach ($categories as $category)
        <option id="{{ $category->id }}" value="{{ $category->name }}">{{ $category->name }}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="service"><b>Service:</b></label>
      <select class="form-control" id="service" name="service">
        <option value="">Select service</option>
      </select>
    </div>
    
   

    <div class="form-group">
    <div class="row"><div class="col"><b>Select Date:</b></div><div class="col d-flex align-items-end justify-content-end" id="workingDaysOutput"></div> </div>
    <label for="date">  </label>
      <input type="hidden" class="form-control" id="date" name="date">
      <!-- calander start -->
      <div class="">
        <div class="calendar-header row d-flex align-items-center">
          <i class="bi bi-caret-left col" id="previousmonth"></i><h2 class="col-8" id="month-year"></h2><i id="nextmonth" class="bi bi-caret-right col"></i>
        </div>
        <div class="calendar-days" id="calendar-days"></div>
      </div>
      <!-- calander end -->
    </div>

    <div ><b>Select Time Slot:</b></div>
    <div class="form-group" id="time">
       <!-- Example usage of the custom radio button -->
    </div>
    <div class="form-group">
      <label for="message"><b>Message:</b></label>
      <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary border-0 py-3 px-5" style="background-color:#0000FF;">Submit</button>
  </form>
  
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function() {
    $('#category').change(function() {
        var categoryId = $(this).find(':selected').attr('id');

        if (categoryId) {
            $.ajax({
                type: "GET",
                url: "/get-services/" + categoryId,
                success: function(data) {
                    $('#service').empty();
                    $('#service').append('<option value="">Select service</option>');
                    $.each(data, function(key, value) {
                        $('#service').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#service').empty();
            $('#service').append('<option value="">Select service</option>');
        }
    });

    // Handle service change separately
    $('#service').change(function() {
    var serviceId = $(this).val();

    if (serviceId) {
        $.ajax({
            type: "GET",
            url: "/get-time-slots/" + serviceId,
            success: function(data) {
            console.table(data); // Log the received data in a tabular format
            updateTimeSlots(data);
            }
        });
    }
});
});

function updateTimeSlots(timeSlots) {
    // Clear existing time slots
    $('#time').empty();

    // Add new time slots
    $.each(timeSlots, function(index, timeSlot) {
        var inputId = 'option' + (index + 1);
        var label = $('<label>', {
            'for': inputId,
            'class': 'radio-label',
            'text': timeSlot.service_start_time + ' - ' + timeSlot.service_end_time
        });

        var input = $('<input>', {
            'type': 'radio',
            'id': inputId,
            'name': 'time',
            'value': timeSlot.id
        });

        $('#time').append(input, label);
    });
}
</script>


<style>
    /* Hide the default radio button */
    input[type="radio"] {
      display: none;
    }

    /* Style the label as the clickable element */
    .radio-label {
      display: inline-block;
      padding: 10px 25px;
      cursor: pointer;
      color:##040303;
      margin:5px;
      background-color: #ffb8b8;
      border:1px solid #b37979; 
      border-radius: 25px;/* Initial background color */
    }

    /* Change background color when the radio button is checked */
    input[type="radio"]:checked + .radio-label {
      background-color: #b1a3a3; /* Change background color when selected */
      color: #000; /* Change text color when selected */
    }
  </style>

  


<!-- calander style -->
<style>
    .calendar-container {
      max-width: 800px;
      margin: auto;
      margin-top: 50px;
    }
    .calendar-header {
      text-align: center;
    }
    .calendar-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      margin-top: 10px;
    }
    .day {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      cursor: pointer;
    }
    .day:hover {
      background-color: #f2d9d9;
    }
    .day.selected {
      background-color: #b1a3a3;
    }
    .day.holiday {
    background-color: #f0f0f0; /* Customize the background color for holiday dates */
    color: #888; /* Customize the text color for holiday dates */
    }
  </style>
  
  
<!-- calander JS -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    // Extract workingDays array from PHP
    const workingDays = {!! json_encode($workingDays) !!};

    // Extract holiday dates array from PHP
    const holidayDates = {!! json_encode($holidayDates) !!};

    function renderCalendar() {
        const monthYearText = new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long', year: 'numeric' });
        document.getElementById('month-year').innerText = monthYearText;

        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        const calendarDays = document.getElementById('calendar-days');
        calendarDays.innerHTML = '';

        // Add day names
        for (let i = 0; i < daysOfWeek.length; i++) {
            const dayName = document.createElement('div');
            dayName.classList.add('day', 'day-name');
            dayName.innerText = daysOfWeek[i];
            calendarDays.appendChild(dayName);
        }

        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);

        for (let i = 0; i < firstDay.getDay(); i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('day', 'empty');
            emptyDay.innerText = ''; // Set an empty text for empty days
            calendarDays.appendChild(emptyDay);
        }

        for (let i = 1; i <= lastDay.getDate(); i++) {
            const day = document.createElement('div');
            day.classList.add('day');

            // Check if the day is a working day
            const currentDay = new Date(currentYear, currentMonth, i).toLocaleDateString('en-US', { weekday: 'short' });

            // Check if the day is a holiday
            const isHoliday = holidayDates.includes(`${currentYear}-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`) || !workingDays.includes(currentDay);

            // Set the text for all days
            day.innerText = i;

            if (!workingDays.includes(currentDay)) {
                day.classList.add('disabled');
            } else {
                day.addEventListener('click', function () {
                    const clickedDate = `${currentYear}-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;

                    // Remove 'selected' class from all days
                    const days = document.querySelectorAll('.day');
                    days.forEach(function (d) {
                        d.classList.remove('selected');
                    });

                    // Add 'selected' class to the clicked day
                    this.classList.add('selected');

                    document.getElementById('date').value = clickedDate;
                    fetchPreBookedServiceSlots(clickedDate);
                });
            }

            // Add additional classes for holidays
            if (isHoliday) {
                day.classList.add('disabled', 'holiday');
            }

            calendarDays.appendChild(day);
        }
    }

    renderCalendar();

    document.getElementById('previousmonth').addEventListener('click', function () {
        currentMonth = (currentMonth - 1 + 12) % 12; // Ensure positive modulo
        if (currentMonth === 0) {
            currentYear--;
        }
        renderCalendar();
    });

    document.getElementById('nextmonth').addEventListener('click', function () {
        currentMonth = (currentMonth + 1) % 12;
        if (currentMonth === 0) {
            currentYear++;
        }
        renderCalendar();
    });
});

</script>




  <!-- show working days -->
  <script>
    const workingDays = {!! json_encode($workingDays) !!};
    const workingDaysArray = Array.isArray(workingDays) ? workingDays : JSON.parse(workingDays);
    const workingDaysOutput = document.getElementById('workingDaysOutput');
    const cleanedWorkingDays = workingDaysArray.map(day => day.replace(/["']/g, ''));
    const workingDaysString = cleanedWorkingDays.join(', ');
    workingDaysOutput.innerHTML = "<p><b>Working Days: </b>" + workingDaysString + "</p>";
  </script>



<!-- disable prebook slot -->
<script>
// Inside your existing script
function fetchPreBookedServiceSlots(selectedDate) {
    // Fetch pre-booked service slots from Laravel backend
    $.ajax({
        type: "GET",
        url: "/get-pre-booked-slots/" + selectedDate,
        success: function(data) {
            // data is an array of pre-booked service slot IDs
            updateDisabledTimeSlots(data);
        },
        error: function(err) {
            console.error('Error fetching pre-booked service slots:', err);
        }
    });
}


function updateDisabledTimeSlots(preBookedSlots) {
    // Disable time slots based on pre-booked service slots
    $('input[type="radio"]').prop('disabled', false); // Enable all time slots initially

    // Hide the time slots that are pre-booked
    $.each(preBookedSlots, function(index, slotId) {
        var inputId = 'option' + (index + 1);
        $('#' + inputId).prop('disabled', true);
    });
}
</script>

<style>
    /* Add this style to hide disabled time slots */
    input[type="radio"]:disabled + .radio-label {
        display: none;
    }
</style>

<!-- <script>
            // ... (your existing script)

            // Fetch holidays from Laravel backend
            function fetchHolidays() {
                $.ajax({
                    type: "GET",
                    url: "/get-holidays",
                    success: function(data) {
                        // data is an array of holiday dates
                        updateDisabledDates(data);
                        console.log(data);
                    },
                    error: function(err) {
                        console.error('Error fetching holidays:', err);
                    }
                });
            }

            function updateDisabledDates(holidays) {
    const calendarDays = document.getElementById('calendar-days');

    holidays.forEach(function (holiday) {
        const holidayParts = holiday.split('-');
        const year = parseInt(holidayParts[0]);
        const month = parseInt(holidayParts[1]) - 1; // Months are zero-indexed
        const day = parseInt(holidayParts[2]);

        const holidayDate = new Date(year, month, day);

        const dayElements = calendarDays.querySelectorAll(`.day`);

        dayElements.forEach(function (dayElement) {
            const dayDate = new Date(dayElement.getAttribute('data-day'));
            console.log('Checking:', dayDate, 'Holiday Date:', holidayDate);

            if (dayDate.getFullYear() === year && dayDate.getMonth() === month && dayDate.getDate() === day) {
                console.log('Marking as holiday:', dayDate);
                dayElement.classList.add('disabled', 'holiday');
            }
        });
    });
}

// Call fetchHolidays when the page is loaded
fetchHolidays();



</script>  -->
@foreach($holidays as $holiday)
        <script>
            console.log('Event Date:', '{{ $holiday->event_date }}');
        </script>
    @endforeach
@endsection

