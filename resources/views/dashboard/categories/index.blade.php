@extends('components.dlayout')

@section('title1', 'Category | Dashboard')

@section('dslot')

<div class="col-md-9">
<div class="container mt-4">
         @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @error('categoryName')
            <span class="text-red-500 py-2 my-3 text-danger bg-light">{{ $message }}</span>
        @enderror
    <h2>Category Table</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Created Time</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample data -->
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td> <!-- Adjust this based on your date format -->
                    </tr>
                @endforeach 
                <!-- ows for additional data --> -->
        </tbody>
    </table>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
        Add Category
    </button>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add Category Form -->
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf    
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input name="categoryName" type="text" class="form-control" id="categoryName" placeholder="Enter Category">
                        
                    </div>
                    <!-- Add more form fields as needed -->
                    <button type="submit" class="btn btn-primary">Add</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
