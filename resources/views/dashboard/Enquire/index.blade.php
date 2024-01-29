@extends('components.dlayout')

@section('title1', 'Requests | Dashboard')

@section('dslot')


<div class="col-md-9">
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
            <th>Time Slot</th>
            <th>Message</th>
            <th>Request Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
  
        <tr>
        @foreach ($requests as $request)
            <td>{{ $request->id }}</td>
            <td>{{ $request->name }}</td>
            <td>{{ $request->email }}</td>
            <td>{{ $request->category }}</td>
            <td>{{ $request->service_name }}</td>
            <td>{{ $request->date }}</td>
            <td>{{ $request->service_start_time }} to {{ $request->service_end_time }}</td>
            <td>{{ $request->message }}</td>
            <td>{{ $request->created_at }}</td>
            <td>
                <a href="{{ route('editenquire', ['id' => $request->id]) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('deleteenquire', ['id' => $request->id]) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    </div>
</div>

      
@endsection