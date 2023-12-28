<x-layout>
    <div class="bg-dark p-4 m-5 rounded">
        <h2 class="col-12 d-flex justify-content-center text-light"><b>Create Post</b></h2>
       <!-- resources/views/create_post.blade.php -->

<form class="col-12 " method="POST" action="{{ route('posts.store1') }}">
    @csrf
    <div class="col-12 my-2 d-flex justify-content-center">
        <label class="col-2 text-light"  for="title">Name:</label>
        <input class="col-6" type="text" name="title" id="title" required>
        @error('title')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-12 d-flex justify-content-center">
        <label class="col-2 text-light" for="body">Body:</label>
        <textarea class="col-6" name="body" id="body" required></textarea>
        @error('body')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="my-2 col-12 d-flex justify-content-center">
        <label class="col-2 text-light" for="address">Address:</label>
        <textarea class="col-6" name="address" id="address" required></textarea>
        @error('address')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="d-flex justify-content-center">
    <button class="btn m-2 col-8 bg-success" type="submit">Create Post</button>
</div>
</form>
    
        @if (session()->has('success'))
    <div class="relative flex flex-col sm:flex-row sm:items-center bg-gray-200 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
        <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
            <div class="text-green-500" dark:text-gray-500>
                <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="text-sm font-medium ml-3">Success!.</div>
        </div>
        <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4"> {{ session('success') }}</div>
        <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>
    </div>
    @endif
    </div>
</x-layout>