@extends('components.dlayout')

@section('title1', 'Requests | Dashboard')

@section('dslot')
<div class="col-md-9">
    <div class="container">
        <h2>Requests Table</h2>
        <table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Category</th>
            <th>Service</th>
            <th>Date</th>
            <th>Time</th>
            <th>Message</th>
            <th>Request Time</th>
        </tr>
    </thead>
    <tbody>
  
        <tr>
            <td>1</td>
            <td>vishal</td>
            <td>vishal@webwideit.solutions</td>
            <td>category1</td>
            <td>service1</td>
            <td>12/1/23</td>
            <td>01:03</td>
            <td>Test</td>
            <td>12/12/24</td>
        </tr>
        
    </tbody>
</table>


    </div>
</div>

      
@endsection