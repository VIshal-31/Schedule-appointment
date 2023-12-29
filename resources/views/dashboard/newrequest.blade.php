@extends('components.dlayout')

@section('title1', 'Requests | Dashboard')

@section('dslot')
            <div class="col-md-9">
            <div class="container">
    <h2>Requests Table</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Category</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Message</th>
                <th>Status</th>
                <th>Request Time</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample data -->
            <tr>
                <td>John Doe</td>
                <td>johndoe@example.com</td>
                <td>Category 1</td>
                <td>Service A</td>
                <td>2023-01-15</td>
                <td>10:00 AM</td>
                <td>Lorem ipsum dolor sit amet</td>
                <td>Pending</td>
                <td>2023-01-10 09:30 AM</td>
            </tr>
            <!-- Add more rows for additional data -->
        </tbody>
    </table>
</div>
            </div>
      
@endsection