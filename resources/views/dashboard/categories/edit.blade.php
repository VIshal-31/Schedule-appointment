@extends('components.dlayout')

@section('title1', 'Category | Dashboard')

@section('dslot')

<div class="col-md-9">

    <h1>Edit Category</h1>
    <!-- Form for editing category details -->
    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT') <!-- For Laravel 8 and above, use @method('PUT') -->
        <!-- Include input fields to update category details -->
        <input type="text" name="name" value="{{ $category->name }}">
        <!-- Other input fields -->
        <button type="submit">Update</button>
    </form>
</div>

@endsection
