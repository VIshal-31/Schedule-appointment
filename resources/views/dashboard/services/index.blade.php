@extends('components.dlayout')

@section('title1', 'Service | Dashboard')

@section('dslot')

<div class="col-md-9">
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>Service Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Service</th>
                    <th>Category</th>
                    <th>Created Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="serviceTableBody">
                @foreach($categories as $category)
                    <tr>
                        <th colspan="5">{{ $category->name }}</th>
                    </tr>
                    @foreach($category->services as $index => $service)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $service->created_at }}</td>
                            <td>
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                     @csrf
                                     @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addServiceModal">
            Add Service
        </button>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Service Form -->
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="categorySelect">Category</label>
                            <select class="form-control" id="categorySelect" name="category_id" required>
                                <option value="">Please Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="serviceName">Service Name</label>
                            <input type="text" name="name" class="form-control" id="serviceName" placeholder="Enter Service Name">
                        </div>
                        <button type="submit" class="btn btn-primary" id="addServiceBtn">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script for handling confirmation and submission -->
<script>
    function confirmDelete(serviceId) {
        if (confirm('Are you sure you want to delete this service?')) {
            window.location.href = "{{ route('services.destroy', ':id') }}".replace(':id', serviceId);
        }
    }
</script>

@endsection
