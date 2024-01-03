@extends('components.dlayout')

@section('title1', 'Category | Dashboard')

@section('dslot')

<div class="col-md-9">

            <div class="modal-body">
                <!-- Add Category Form -->
                <form method="POST" action="{{ route('categories.update', $category->id) }}">
              @csrf
                 @method('PUT')    
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" name="name" value="{{ $category->name }}">
                    </div>
                    <!-- Add more form fields as needed -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    
                </form>
            </div>
            </div>


@endsection
