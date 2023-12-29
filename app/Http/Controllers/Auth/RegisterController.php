<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
   // Validate the incoming request
   $validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|string|min:8',
    ]);

       // Hash the password before saving it
       $validatedData['password'] = Hash::make($validatedData['password']);

       $user = User::create($validatedData);
   
       return redirect()->route('dashboard')->with('success', 'Registration successful!');
   
}

}