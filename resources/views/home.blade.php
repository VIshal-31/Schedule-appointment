@extends('components.layout')

@section('title', 'Home')

@section('slot')


<div class="container my-4">
  <h2>Contact Form</h2>
  <form action="{{ route('submit.form') }}" method="POST">
    <!-- Form fields -->
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Enter your name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Enter your email">
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" id="category">
        <option value="">Select category</option>
        <option value="category1">Category 1</option>
        <option value="category2">Category 2</option>
        <option value="category3">Category 3</option>
      </select>
    </div>
    <div class="form-group">
      <label for="service">Service</label>
      <select class="form-control" id="service">
        <option value="">Select service</option>
        <option value="service1">Service 1</option>
        <option value="service2">Service 2</option>
        <option value="service3">Service 3</option>
      </select>
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" class="form-control" id="date">
    </div>
    <div class="form-group">
      <label for="time">Time</label>
      <input type="time" class="form-control" id="time">
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection

