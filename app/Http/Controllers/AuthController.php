<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // show signup form
    public function signup()
    {
        return view('auth.signup');
    }

    // show login form
    public function login()
    {
        return view('auth.login');
    }


  // register users
    public function store(Request $request)
    {

        $formFields = $request->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone_number' => ['required', 'string', 'max:15'],
            'user_type' => ['required', Rule::in(['student', 'company'])],
            'category' => ['required_if:user_type,student'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // create user
        $user = new User();
        $user->name = $formFields['name'];
        $user->email = $formFields['email'];
        $user->password = $formFields['password'];
        $user->phone_number = $formFields['phone_number'];
        $user->user_type = $formFields['user_type'];
        if ($user->user_type == 'student') {
            $user->category = $formFields['category'];
        }

        $user->save();


        // login
        auth()->login($user);

        // Redirect based on user type
        if ($user->user_type == 'student') {
            return redirect()->route('student_home')->with('message', 'Your account has been created Successfuly!');
        } elseif ($user->user_type == 'company') {
            return redirect()->route('company_home')->with('message', 'Your account has been Successfully created!');
        }
    }

    // log out user
    public function logout(Request $request) {
         auth()->logout();

         $request->session()->invalidate();
         $request->session()->regenerateToken();

         return redirect('/')->with('message', 'You have been Logged Out.');
    }

    // log user in (authenticate user)
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            // Redirect based on user type
            if (auth()->user()->user_type == 'student') {
                
                return redirect()->route('student_home')->with('message', 'Welcome back! You are Logged in Successfully');
            } elseif (auth()->user()->user_type == 'company') {
                return redirect()->route('company_home')->with('message', 'Welcome back! You are Logged in Successfully');
            }
            
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->onlyInput('email');
    }

}
