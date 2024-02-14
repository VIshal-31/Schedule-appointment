@extends('components.dlayout')

@section('title1', 'Requests | Dashboard')

@section('dslot')
<style>
.table td, th {
      text-align: center;
      vertical-align: middle;
    }
</style>
<div class="col-md-10">
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
        <table class="table mb-4">
    <thead>
        <tr>
            <th scope="col" class="align-middle">Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Category</th>
            <th>Service</th>
            <th>Date</th>
            <th>Time Slot</th>
            <th>Status</th>
            <!-- <th>Message</th> -->
            <th>Request Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
  
        <tr>
        @foreach ($requests->sortByDesc('created_at') as $request)
            <td>{{ $request->id }}</td>
            <td>{{ $request->name }}</td>
            <td><a href="mailto:{{ $request->email }}"><i class="bi bi-envelope-at-fill" data-toggle="tooltip" data-placement="top" title="{{ $request->email }}"></i></a></td>
            <td ><a href="tel:{{ $request->contact }}"><i class="bi bi-telephone-plus-fill" data-toggle="tooltip" data-placement="top" title="{{ $request->contact }}"></i></td>
            <td>{{ $request->category }}</td>
            <td>{{ $request->service_name }}</td>
            <td class="col-2">{{ $request->date }}</td>
            <td>{{ $request->service_start_time }}<br> to<br> {{ $request->service_end_time }}</td>
            <td>{{ $request->Status }}</td>
            <!-- <td>{{ $request->message }}</td> -->
            <td>{{ $request->created_at }}</td>
            <td>
                        <div class="btn-group">
                            <button type="button" class="rounded btn-primary bi bi-three-dots-vertical"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                   href="{{ route('editenquire', ['id' => $request->id]) }}">Edit</a>
                                <form action="{{ route('deleteenquire', ['id' => $request->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Are you sure you want to delete?')">Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr class="">

<div class="row flex items-center justify-between">

    <div class="col-3 flex">
        @if ($requests->onFirstPage())
       <span class="bi bi-caret-left px-2 py-2 text-gray-300" style="font-size:20px;">   Previous</span>
        @else
        <b><a href="{{ $requests->previousPageUrl() }}" style="font-size:20px;" class="px-2 py-1 text-blue-500 hover:underline"><i class="bi bi-caret-left-fill"></i>Previous</a></b>
        @endif
    </div>

    <div class="col-6 flex" style="font-size:20px;">
        @foreach ($requests->getUrlRange(1, $requests->lastPage()) as $page => $url)
            @if ($page == $requests->currentPage())
                <span class="px-2 py-1 text-blue-500 font-semibold">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-2 py-1 text-gray-500 hover:underline">{{ $page }}</a>
            @endif
        @endforeach
    </div>

    <div class="col-3 flex">
        @if ($requests->hasMorePages())
            <a href="{{ $requests->nextPageUrl() }}" style="font-size:20px;" class=" px-2 py-1 text-blue-500 hover:underline">Next <i class="bi bi-caret-right-fill"> </i></a>
        @else
            <span class="px-2 py-1 text-gray-300" style="font-size:20px;">Next <i class="bi bi-caret-right "> </i></span>
        @endif
    </div>
</div>



    </div>
</div>
<style>
.pagination {
    color: black;
    display: flex;
    justify-content: center;
}

    </style>
      
@endsection