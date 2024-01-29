@extends('components.dlayout')

@section('title1', 'Service | Dashboard')

@section('dslot')

<style>
    .checkbox-container {
  display: inline-block;
  position: relative;
}

/* Hide the default checkbox */
.checkbox-container input[type="checkbox"] {
  opacity: 0;
}

/* Style the custom checkbox */
.checkbox-container label {
  cursor: pointer;
  border: 2px solid #b39b9b;
  border-radius: 50%;
  display: inline-block;
  width: 50px;
  height: 50px;
  transition: background-color 0.3s ease;
}

/* Change background color when checkbox is checked */
.checkbox-container input[type="checkbox"]:checked + label {
  background-color: #3b3a3a;
  color: #fff;
}

  </style>  

<div class="card col-md-9">
<div class="mb-5">
<!-- success -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Error -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="col-12 p-2">
        <div id="shopname1" class="row col card-header">
            <h1>{{ $shop->name }}</h1>
            <button id="editshopname" class="px-3 btn bi bi-pencil-square text-primary"></button>
       </div>
        <div id="shopnameform" class="col" style="display:none;">
        <h1 class="col m-0">
        <form class="row" id="shopForm" action="{{ route('update.shop.name') }}" method="post">
            @csrf
            <input class="col-5" type="text" id="shopName" name="name" placeholder="{{ $shop->name }}">
            <button type="submit" id="saveshopname" class="mx-1 col-2 text-light btn px-4 border-0 rounded-0 bg-success d-flex align-items-center justify-contet-center"><i class="bi bi-floppy2-fill p-2"></i>Save</button>
        </form>
        </div>
        
    </div>
    <div class="row my-3">

    <!-- Opening time -->
        <div class="col-6">
            <div class="col-10">
                <h3 class="">Shop opening Time</h3>
                    <div id="shopopeningtime">
                        <h5 class="text-primary">{{ $shop->opening_time }}<button id="editopeningtime" class="btn bi bi-pencil-square text-primary"></button></h5>
                    </div>
                    <div class="input-group" id="shopopeningtimeform" style="display:none;">
                    
                    <form class="row col" action="{{ route('update.shop.start-time') }}" method="post">
                    @csrf
                    <div class="input-group-prepend">
                            <input name="start_time" type="time" class="form-control border-0 rounded-0 p-0" id="inlineFormInputGroup">
                        </div>
                        <button 
                          type="Submit" id="saveopeningtime"  class="text-primary btn px-3 bi bi-floppy2-fill border-0 rounded-0 bg-transparent d-flex align-items-center">
                        </button>
                    </form>
                    </div>
            </div>
            <hr class="">
        </div>
        
        <!-- Closing Time -->
        <div class="col-6">
            <div class="col-10">
                <h3 class="">Shop Closing Time</h3>
                    <div id="shopclosingtime">
                        <h5 class="text-primary">{{ $shop->closing_time }}<button id="editclosingtime" class="btn bi bi-pencil-square text-primary"></button></h5>
                    </div>
                    <div class="input-group" id="shopclosingtimeform" style="display:none;">
                        <form class="row col" action="{{ route('update.shop.closing-time') }}" method="post">
                        @csrf
                        <div class="input-group-prepend">
                                <input name="closing_time" type="time" class="form-control border-0 rounded-0 p-0" id="inlineFormInputGroup1">
                            </div>
                            <button 
                              type="Submit" id="saveclosingingtime" class="text-primary btn px-3 bi bi-floppy2-fill border-0 rounded-0 bg-transparent d-flex align-items-center">
                            </button>
                        </form>
                    </div>
            </div>
            <hr class="">
        </div> 
    </div>

<!-- Week Days -->
    <div class="pb-3">
        <h3 class="col-12 px-2">Shop Weekly Working Days</h3>
            <div class="col-12 row p-2" id="shopweekdays"> 
                
             @php
             $allDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            @endphp

            @foreach($allDays as $day)
            @php
            $isDayPresent = in_array($day, $workingDays);
            $backgroundColor = $isDayPresent ? '#3b3a3a' : '#EE4B2B' ;
            @endphp
                <div class="checkbox-container m-2">
                <input type="checkbox" style="display:none;" id="{{ $day }}" value="{{ $day }}" {{ $isDayPresent ? 'checked' : '' }}>
             <label for="{{ $day }}" style="background-color: {{ $backgroundColor }}; color: {{ $isDayPresent ? '#fff' : '#000' }}; display: flex; align-items: center; justify-content: center;">{{ $day }}</label>
                </div>
             @endforeach
            

                <div class=" rounded-circle m-2  bg- d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class=""><button  id="editshopweekdays" class="btn text-primary bi bi-pencil-square" style="font-size:20px;"></button></div>
                </div>  
                
                
            </div>
            <div class="col-12 row p-2" id="shopweekdaysform" style="display:none;"> 
                <form class="row col-7" method="post" action="{{ route('update.shop.workingdays') }}" >
                @csrf
                    <div class="checkbox-container m-2 " >
                        <div>
                        <input style="display:none;"  value="Mon" name="days[]" type="checkbox" id="myCheckbox1" class="ratio ratio-1x1 text-light">
                        <label for="myCheckbox1" id="my" style="display: flex; align-items: center; justify-content: center;">Mon</label>
                        </div>
                    </div>
                    <div class="checkbox-container m-2 " >
                        <div>
                        <input style="display:none;" value="Tue" name="days[]" type="checkbox" id="myCheckbox2" class="ratio ratio-1x1 text-light">
                        <label for="myCheckbox2" id="my" style="display: flex; align-items: center; justify-content: center;">Tue</label>
                        </div>
                    </div>
                    <div class="checkbox-container m-2 " >
                        <div>
                        <input style="display:none;" value="Wed" name="days[]" type="checkbox" id="myCheckbox3" class="ratio ratio-1x1 text-light">
                        <label for="myCheckbox3" id="my" style="display: flex; align-items: center; justify-content: center;">Wed</label>
                        </div>
                    </div>
                    <div class="checkbox-container m-2 " >
                        <div>
                        <input style="display:none;" value="Thu" name="days[]" type="checkbox" id="myCheckbox4" class="ratio ratio-1x1 text-light">
                        <label for="myCheckbox4" id="my" style="display: flex; align-items: center; justify-content: center;">Thu</label>
                        </div>
                    </div>
                    <div class="checkbox-container m-2 " >
                        <div>
                        <input style="display:none;" value="Fri" name="days[]" type="checkbox" id="myCheckbox5" class="ratio ratio-1x1 text-light">
                        <label for="myCheckbox5" id="my" style="display: flex; align-items: center; justify-content: center;">Fri</label>
                        </div>
                    </div>
                    <div class="checkbox-container m-2 " >
                        <div>
                        <input style="display:none;" value="Sat" name="days[]" type="checkbox" id="myCheckbox6" class="ratio ratio-1x1 text-light">
                        <label for="myCheckbox6" id="my" style="display: flex; align-items: center; justify-content: center;">Sat</label>
                        </div>
                    </div>
                    <div class="checkbox-container m-2 " >
                        <div>
                        <input style="display:none;" value="Sun" name="days[]" type="checkbox" id="myCheckbox7" class="ratio ratio-1x1 text-light">
                        <label for="myCheckbox7" id="my" style="display: flex; align-items: center; justify-content: center;">Sun</label>
                        </div>
                    </div>
                    <div class=" rounded-circle m-2  bg- d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                        <div class=""><button type="submit"  id="saveshopweekdays" class="btn text-primary bi bi-floppy2-fill" style="font-size:20px;"></button></div>
                    </div> 
                    
                </form> 
                    <div class=" rounded-circle m-2  bg- d-flex align-items-center justify-content-start" style="width:50px; height:50px;">
                        <div class=""><button id="cancelshopweekdays" class="btn text-primary bi bi-x-circle-fill" style="font-size:20px;"></button></div>
                    </div>
            </div>
        <hr>
    </div>

<!-- Holiday -->
    <div class="col-12 p-0 row">
        <div class="col-6"> 
        <h3>Shop Holiday</h3>
        </div> 
            <div class="col-6 d-flex align-items-center justify-content-end">
            <button id="addholidays" class="btn bg-dark text-light">Add Holidays</button>
        </div> 
        </div> 

        
        <!-- Your Blade view file -->
        <div id="shopholiday" class="row my-4">
    <div class="col-4"> 
        <label for="month1"><b>Select a month:</b></label>
        <select id="month1" name="month1" style="height:35px;">
            @for ($i = 0; $i < 12; $i++)
                <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i+1, 1)) }}</option>
            @endfor
        </select>
    </div>
    <div class="col-4 row">
        <label class="col-6" for="year1"><b>Select a year:</b></label>
        <input class="col-6" type="number" id="year1" name="year1" style="height:35px" value="{{ date('Y') }}">
    </div>   
    <button id="Show" class="btn bg-dark text-light mx-2">Show</button>

    <div class="col-12 mt-4"> 
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                </tr>
            </thead>
            <tbody id="holidaysTableBody">
                <!-- Holidays will be dynamically added here -->
                @foreach ($holidays as $holiday)
                    <tr data-date="{{ $holiday->event_date }}">
                        <td>{{ $holiday->id }}</td>
                        <td>{{ $holiday->event_name }}</td>
                        <td>{{ $holiday->event_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


        <div id="shopholidayform" style="display:none;" class="my-2 row ">
       
        <form class="col-6" action="{{ route('holidays.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-5">
                    <input type="text" name="event_name" class="form-control" placeholder="Event Name" required>
                </div>
                <div class="col-5">
                    <input type="date" name="event_date" class="form-control" placeholder="Select date" required>
                </div>
                <div class="col-2">
                    <button id="saveholidays" class="btn bg-info text-light" type="submit">Submit</button>
                </div>
            </div>
        </form>
            <div class="col-4  mx-0">
                <button id="cancelholidays" class="btn bg-info text-light" >cancel</button>
            </div>

        </div>
        </div>

<style>
   
       /* check box style */
    .checkbox-container {
      display: inline-block;
      position: relative;
    }

    /* Hide the default checkbox */
    .checkbox-container input[type="checkbox"] {
      opacity: 0;
    }

    /* Style the custom checkbox */
    .checkbox-container label {
      cursor: pointer;
      border: 2px solid #b39b9b;
      border-radius: 50%;
      display: inline-block;
      width: 50px;
      height: 50px;
      transition: background-color 0.3s ease;
    }

    /* Change background color when checkbox is checked */
    .checkbox-container input[type="checkbox"]:checked + label {
      background-color: #3b3a3a;
      color: #fff;
    }

  </style>


<!-- holidays -->
<script>

    document.addEventListener('DOMContentLoaded', function() {
        // Trigger a click event on the "Show" button
        document.getElementById('Show').click();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Fetch holidays for the default month and year
        fetchHolidays('{{ date('n') }}', '{{ date('Y') }}');
    });

    document.getElementById('Show').addEventListener('click', function() {
        var selectedMonth = document.getElementById('month1').value;
        var selectedYear = document.getElementById('year1').value;

        // Fetch holidays for the selected month and year
        fetchHolidays(selectedMonth, selectedYear);
    });

    function fetchHolidays(month, year) {
        fetch('/dashboard/show-filtered-holidays', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                month: month,
                year: year,
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Update the table with the fetched holidays
            var tableBody = document.getElementById('holidaysTableBody');
            tableBody.innerHTML = ''; // Clear existing rows

            data.holidays.forEach(function(holiday) {
                var row = document.createElement('tr');
                row.innerHTML = '<td>' + holiday.id + '</td>' +
                                '<td>' + holiday.event_name + '</td>' +
                                '<td>' + holiday.event_date + '</td>';

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
    }
</script>

<script>
    document.getElementById('Show').addEventListener('click', function() {
        var selectedMonth = document.getElementById('month1').value;
        var selectedYear = document.getElementById('year1').value;

        var tableRows = document.querySelectorAll('#shopholiday table tbody tr');

        tableRows.forEach(function(row) {
            var eventDate = row.getAttribute('data-date');
            var rowMonth = new Date(eventDate).getMonth();
            var rowYear = new Date(eventDate).getFullYear();

            if (rowMonth == selectedMonth && rowYear == selectedYear) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>



<script>
    function updateCalendar() {
      const year = document.getElementById("year").value;
      const month = document.getElementById("month").value;
      createCalendar(year, month);
    }

    function createCalendar(year, month) {
      const calendarDiv = document.getElementById("calendar");
      calendarDiv.innerHTML = '';

      const daysInMonth = new Date(year, parseInt(month) + 1, 0).getDate();
      const firstDayIndex = new Date(year, month, 1).getDay();

      const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      daysOfWeek.forEach(day => {
        const dayLabel = document.createElement("label");
        dayLabel.textContent = day;
        calendarDiv.appendChild(dayLabel);
      });

      for (let i = 0; i < firstDayIndex; i++) {
        const emptyLabel = document.createElement("label");
        calendarDiv.appendChild(emptyLabel);
      }

      for (let i = 1; i <= daysInMonth; i++) {
        const label = document.createElement("label");
        label.setAttribute("onclick", `selectDate(${year}, ${month}, ${i})`);
        label.textContent = i;
        calendarDiv.appendChild(label);
      }
    }

    function selectDate(year, month, day) {
      const selectedDate = new Date(year, month, day);
      document.getElementById("selectedDate").value = selectedDate.toISOString().split('T')[0];
      
      const labels = document.querySelectorAll('.calendar label');
      labels.forEach(label => label.classList.remove('selected'));

      const selectedLabel = event.target;
      selectedLabel.classList.add('selected');
      console.log(`Selected date: ${selectedDate.toDateString()}`);
    }

    // Initialize the calendar for the current month on page load
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();
    createCalendar(currentYear, currentMonth);
  </script>

<!--  for closing time -->
<script>
    // Get the elements
    const shopClosingTime = document.getElementById("shopclosingtime");
    const shopClosingTimeForm = document.getElementById("shopclosingtimeform");
    const editClosingTimeButton = document.getElementById("editclosingtime");
    const saveClosingTimeButton = document.getElementById("saveclosingtime");

    // Function to toggle visibility
    function toggleVisibility(elementToShow, elementToHide) {
        elementToHide.style.display = "none";
        elementToShow.style.display = "";
    }

    // Event listeners
    editClosingTimeButton.addEventListener("click", function() {
        toggleVisibility(shopClosingTimeForm, shopClosingTime);
    });

    saveClosingTimeButton.addEventListener("click", function() {
        toggleVisibility(shopClosingTime, shopClosingTimeForm);
});

</script>

<!-- for opening time -->
<script>
    // Get the elements
    const shopOpeningTime = document.getElementById("shopopeningtime");
    const shopOpeningTimeForm = document.getElementById("shopopeningtimeform");
    const editOpeningTimeButton = document.getElementById("editopeningtime");
    const saveOpeningTimeButton = document.getElementById("saveopeningtime");

    // Function to toggle visibility
    function toggleVisibility(elementToShow, elementToHide) {
        elementToHide.style.display = "none";
        elementToShow.style.display = "";
    }

    // Event listeners
    editOpeningTimeButton.addEventListener("click", function() {
        toggleVisibility(shopOpeningTimeForm, shopOpeningTime);
    });

    saveOpeningTimeButton.addEventListener("click", function() {
        toggleVisibility(shopOpeningTime, shopOpeningTimeForm);
});

</script>


<!--  for weekdays -->
<script>
    // Get the elements
    const shopWeekdays = document.getElementById("shopweekdays");
    const shopWeekdaysForm = document.getElementById("shopweekdaysform");
    const editShopweekdays = document.getElementById("editshopweekdays");
    const saveShopweekdays = document.getElementById("saveshopweekdays");
    const cancelShopweekdays = document.getElementById("cancelshopweekdays");

    
    // Function to toggle visibility
    function toggleVisibility(elementToShow, elementToHide) {
        elementToHide.style.display = "none";
        elementToShow.style.display = "flex";
    }

    // Event listeners
    editShopweekdays.addEventListener("click", function() {
        toggleVisibility(shopWeekdaysForm, shopWeekdays);
    });

    saveShopweekdays.addEventListener("click", function() {
        toggleVisibility(shopWeekdays, shopWeekdaysForm);   
    });

    cancelShopweekdays.addEventListener("click", function() {
        toggleVisibility(shopWeekdays, shopWeekdaysForm);   
    });

</script>

<!--  for holidays -->
<script>
    // Get the elements
    const shopHoliday = document.getElementById("shopholiday");
    const shopHolidayForm = document.getElementById("shopholidayform");
    const addHolidays = document.getElementById("addholidays");
    const saveHolidays = document.getElementById("saveholidays");
    const cancelHolidays = document.getElementById("cancelholidays");
    

    // Function to toggle visibility
    function toggleVisibility(elementToShow, elementToHide) {
        elementToHide.style.display = "none";
        elementToShow.style.display = "flex";
    }

    // Event listeners
    addHolidays.addEventListener("click", function() {
        toggleVisibility(shopHolidayForm, shopHoliday);
    });

    saveHolidays.addEventListener("click", function() {
        toggleVisibility(shopHoliday, shopHolidayForm);   
    });

    cancelHolidays.addEventListener("click", function() {
        toggleVisibility(shopHoliday, shopHolidayForm);   
    });

 
</script>



<!--  for Shop Name -->
<script>
    // Get the elements
    const shopName = document.getElementById("shopname1");
    const shopNameForm = document.getElementById("shopnameform");
    const editShopName = document.getElementById("editshopname");
    const saveShopName = document.getElementById("saveshopname");
    
    

    // Function to toggle visibility
    function toggleVisibility(elementToShow, elementToHide) {
        elementToHide.style.display = "none";
        elementToShow.style.display = "flex";
    }

    // Event listeners
    editShopName.addEventListener("click", function() {
        toggleVisibility(shopNameForm, shopName);
    });

    saveShopName.addEventListener("click", function() {
        toggleVisibility(shopName, shopNameForm);   
    });

    
</script>

<!-- Change shop name -->




@endsection


