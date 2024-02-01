<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Role;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;

            // Fetch user role
            $role = $user->roles->first()->name;

            // Redirect based on the user's role
            if ($role === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Login successful');
            } else {
                return redirect('/user/dashboard')->with('success', 'Login successful');
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

   

    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            // Validate the request data
        'firstname' => 'required|alpha',
        'lastname' => 'required|alpha',
        'email' => 'required|email|unique:users',
        'phoneNumber' => 'required|numeric',
        'postcode' => 'required',
        'role' => 'required|in:1,2', // Ensure the role is either 1 or 2
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // var_dump($request->all());
        // die();
        // Create a new user
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'phoneNumber' => $request->input('phoneNumber'),
            'postcode' => $request->input('postcode'),
            'password' => bcrypt($request->input('password')),
            'hobbies' => $request->input('hobbies'),
            'state' => $request->input('state'),
            'gender' => $request->input('gender'),
            // Add other user fields
        ]);
        // Handle file uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('user_images'); // Adjust the storage path as needed
                $imagePaths[] = $path;
            }
        }
        // Save comma-separated image paths in the user's 'images' field
        $user->update(['images' => implode(',', $imagePaths)]);

        // Attach the role to the user
        $role = $request->input('role');
        $user->roles()->attach($role);
        
        // Generate a personal access token for the user
        // var_dump($token);
        // die();
        $token = $user->createToken('API Token')->accessToken;
        // var_dump($user, $token);
        // die();
        // Optionally, you can authenticate the user using Laravel Passport
        // Auth::login($user); // Commented out as it's not required for API token authentication

        // Return a response with the generated token
        return response()->json(['token' => $token, 'message' => 'Registration successful'], 200);
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
    
}
