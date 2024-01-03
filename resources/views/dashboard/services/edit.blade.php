@extends('components.dlayout')

@section('title1', 'Service | Dashboard')

@section('dslot')

<div class="col-md-9">
    <!-- Edit Service Form -->
    <h1>Edit Service</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 
    <form action="{{ route('services.update', ['service' => $service->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" id="category_id" required >
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $service->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" name="name" class="form-control" id="service_name" value="{{ $service->name }}">
        </div>
        <!-- Other form fields -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection