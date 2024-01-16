@extends('components.layout')

@section('title', 'Home')

@section('slot')


<div class="container my-4">
  <div class="d-flex align-items-center justify-content-center m-3"><h1><b>{{ $shop->name }}</b></h1></div>
  <div class="row"><h3 class="col">Book Your Appoitment Now</h3><h4>Opening Time : {{ $shop->opening_time }} - Closing Time : {{ $shop->closing_time }}</h4></div>
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
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" id="category" name="category">
        <option value="">Please Select Category</option>
        @foreach ($categories as $category)
        <option id="{{ $category->id }}" value="{{ $category->name }}">{{ $category->name }}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="service">Service</label>
      <select class="form-control" id="service" name="service">
        <option value="">Select service</option>
      </select>
    </div>

    <div class="form-group">
    <label for="date"><b>Select Date:</b></label>
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
    <div class="form-group">
      <label for="time"><b>Select Time Slot:</b></label>
       <!-- Example usage of the custom radio button -->
        <input type="radio" id="option1" name="example">
        <label for="option1" class="radio-label">Option 1</label>

        <input type="radio" id="option2" name="example">
        <label for="option2" class="radio-label">Option 2</label>

        <input type="radio" id="option3" name="example">
        <label for="option3" class="radio-label">Option 3</label>

        <input type="radio" id="option4" name="example">
        <label for="option4" class="radio-label">Option 4</label>
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
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
                            $('#service').append('<option value="' + value.name + '">' + value.name + '</option>');
                            
                          });
                    }
                    


                });
            } else {
                $('#service').empty();
                $('#service').append('<option value="">Select service</option>');
            }
        });
    });
</script>


<style>
    /* Hide the default radio button */
    input[type="radio"] {
      display: none;
    }

    /* Style the label as the clickable element */
    .radio-label {
      display: inline-block;
      padding: 10px;
      cursor: pointer;
      background-color: #fff; /* Initial background color */
    }

    /* Change background color when the radio button is checked */
    input[type="radio"]:checked + .radio-label {
      background-color: #00f; /* Change background color when selected */
      color: #fff; /* Change text color when selected */
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
      background-color: #f5f5f5;
    }
  </style>

  <!-- calander JS -->

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

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
        calendarDays.appendChild(emptyDay);
      }

      for (let i = 1; i <= lastDay.getDate(); i++) {
        const day = document.createElement('div');
        day.classList.add('day');
        day.innerText = i;
        day.addEventListener('click', function () {
          const clickedDate = `${currentYear}-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
          // alert(`You clicked on ${clickedDate}`);
          document.getElementById('date').value = clickedDate;
        });
        calendarDays.appendChild(day);
      }
    }

    renderCalendar();

    document.getElementById('previousmonth').addEventListener('click', function () {
      currentMonth = (currentMonth - 1) % 12;
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


@endsection

