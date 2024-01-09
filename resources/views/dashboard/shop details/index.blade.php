@extends('components.dlayout')

@section('title1', 'Service | Dashboard')

@section('dslot')

<div class="col-md-9">

<!-- Title -->
    <div class="col-12 p-2">
        <h1>Vishal's Shop</h1><hr>
    </div>
    <div class="row my-3">

    <!-- Opening time -->
        <div class="col-6 p-2">
            <div class="col-10">
                <h3 class="">Shop opening Time</h3>
                    <div id="shopopeningtimeform">
                        <h5 class="text-primary">06:30 PM <a class="bi bi-pencil-square"></a></h5>
                    </div>
                    <div class="input-group" id="shopopeningtimeform" style="display:none;">
                        <div class="input-group-prepend">
                            <input type="time" class="form-control border-0 rounded-0 p-0" id="inlineFormInputGroup" placeholder="09:15 AM">
                        </div>
                        <a 
                            class="bi bi-floppy2-fill border-0 rounded-0 bg-transparent d-flex align-items-center">
                        </a>
                    </div>
            </div>
            <hr class="">
        </div>

        <!-- Closing Time -->
        <div class="col-6">
            <div class="col-10">
                <h3 class="">Shop Closing Time</h3>
                    <div id="shopclosingtime">
                        <h5 class="text-primary">06:30 PM <a class="bi bi-pencil-square"></a></h5>
                    </div>
                    <div class="input-group" id="shopclosingtimeform" style="display:none;">
                        <div class="input-group-prepend">
                            <input type="time" class="form-control border-0 rounded-0 p-0" id="inlineFormInputGroup" placeholder="09:15 AM">
                        </div>
                        <a 
                            class="bi bi-floppy2-fill border-0 rounded-0 bg-transparent d-flex align-items-center">
                        </a>
                    </div>
            </div>
            <hr class="">
        </div> 
    </div>

<!-- Week Days -->
    <div class="pb-3">
        <h3 class="col-12 px-2">Shop Weekly Working Days</h3>
            <div class="col-12 row p-2" id="shopweekdays"> 
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Mon</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Tue</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Wed</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Thu</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Fri</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-light d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-dark">Sat</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-light d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-dark">Sun</div>
                </div>
                <div class=" rounded-circle m-2  bg- d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class=""><a class="bi bi-pencil-square" style="font-size:20px;"></a></div>
                </div>  
            </div>
            <div class="col-12 row p-2" id="shopweekdaysform" style="display:none;"> 
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Mon</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Tue</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Wed</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Thu</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-secondary d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-light">Fri</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-light d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-dark">Sat</div>
                </div>
                <div class="border border-1 border-dark rounded-circle m-2  bg-light d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class="ratio ratio-1x1 text-dark">Sun</div>
                </div>
                <div class=" rounded-circle m-2  bg- d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                    <div class=""><a class="bi bi-pencil-square" style="font-size:20px;"></a></div>
                </div>  
            </div>
        <hr>
    </div>

<!-- Holiday -->
    <div col="col-12 p-2 row">
        <div class="col-4"> 
        <h3>Shop Holiday</h3>
        </div> 
            <div class="col-6 d-flex align-items-center justify-content-end">
                    <button class="btn bg-dark text-light">Add Holiday</button>
        </div> 
        

        <div>
            <div id-="shopholiday" class="row">
                <div class="col-3"> 
                    <label for="month">Select a month:</label>
                    <select id="month" name="month" onchange="updateCalendar()">
                      @for ($i = 0; $i < 12; $i++)
                        <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i+1, 1)) }}</option>
                      @endfor
                    </select>
                </div>
                <div class="col-3">
                    <label for="year">Select a year:</label>
                    <input type="number" id="year" name="year" min="1900" max="2100" value="2024" onchange="updateCalendar()">
                </div>   
            </div>
            
            <div> 
                <ul>
                    <li>a</li>
                </ul>
            </div>
        </div>


        <div id="shopholidayform">
            <form method="POST" action="">
                @csrf
                <label for="selectedDate">Select a date:</label>
                <input type="hidden" id="selectedDate" name="selectedDate">

                <label for="month">Select a month:</label>
                <select id="month" name="month" onchange="updateCalendar()">
                  @for ($i = 0; $i < 12; $i++)
                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i+1, 1)) }}</option>
                  @endfor
                </select>

                <label for="year">Select a year:</label>
                <input type="number" id="year" name="year" min="1900" max="2100" value="2024" onchange="updateCalendar()">

                <div class="calendar" id="calendar"></div>

                <button type="submit">Submit</button>
            </form>
        </div>


<style>
    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 5px;
    }
    .calendar label {
      display: block;
      text-align: center;
      padding: 5px;
      border: 1px solid #ccc;
      cursor: pointer;
    }
    .selected {
      background-color: lightblue;
      font-weight: bold;
    }
  </style>

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
@endsection
