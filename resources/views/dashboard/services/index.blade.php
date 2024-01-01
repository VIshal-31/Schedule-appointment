@extends('components.dlayout')

@section('title1', 'Service | Dashboard')

@section('dslot')

<div class="col-md-9">
<div class="container mt-4">
    <h2>Service Table</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Category</th>
                <th>Created Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="serviceTableBody"> <!-- Add an ID to the table body for dynamically adding rows -->
            <!-- Sample data -->
            <tr>
                <td>Service A</td>
                <td><a href="#">Category A</a></td>
                <td>2023-01-15 09:30 AM</td>
                <td>
                    <button class="btn btn-primary btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            <!-- Add more rows for additional data -->
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
                <form id="addServiceForm">
                    <div class="form-group">
                        <label for="categorySelect">Category</label>
                        <select class="form-control" id="categorySelect">
                            <option value="Category A">Category A</option>
                            <!-- Add more options -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="serviceName">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" placeholder="Enter Service Name">
                    </div>
                    <button type="submit" class="btn btn-primary" id="addServiceBtn">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        // Submit form to add a service
        $('#addServiceForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            // Get values from form fields
            var categoryName = $('#categorySelect').val();
            var serviceName = $('#serviceName').val();
            // AJAX request to add the service (Update this with your backend endpoint)
            $.ajax({
                url: '/add-service', // Replace with your backend endpoint
                method: 'POST',
                data: { category: categoryName, service: serviceName },
                success: function(response) {
                    // Handle success response (e.g., add a new row to the table)
                    var newRow = '<tr>' +
                        '<td>' + serviceName + '</td>' +
                        '<td><a href="#">' + categoryName + '</a></td>' +
                        '<td>' + new Date().toISOString() + '</td>' +
                        '<td>' +
                            '<button class="btn btn-primary btn-sm">Edit</button>' +
                            '<button class="btn btn-danger btn-sm">Delete</button>' +
                        '</td>' +
                        '</tr>';
                    $('#serviceTableBody').append(newRow);
                    $('#addServiceModal').modal('hide'); // Hide the modal after adding
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                }
            });
        });
    });
</script>

@endsection