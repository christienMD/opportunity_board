<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Display the signup form for new users.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function signup(): View
    {
        return view('auth.signup');
    }

    /**
     * Display the login form for existing users.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function login(): View
    {
        return view('auth.login');
    }


    /**
     * Store a new user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
            return redirect()->route('student.index')->with('message', 'Your account has been created Successfuly!');
        } elseif ($user->user_type == 'company') {
            return redirect()->route('company.index')->with('message', 'Your account has been Successfully created!');
        }
    }

    /**
     * Log out the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
     {
         auth()->logout();

         $request->session()->invalidate();
         $request->session()->regenerateToken();

         return redirect('/')->with('message', 'You have been Logged Out.');
    }

    /**
     * Authenticate an existing user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
     {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            // Redirect based on user type
            if (auth()->user()->user_type == 'student') {
                
                return redirect()->route('student.index')->with('message', 'Welcome back! You are Logged in Successfully');
            } elseif (auth()->user()->user_type == 'company') {
                return redirect()->route('company.index')->with('message', 'Welcome back! You are Logged in Successfully');
            }
            
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->onlyInput('email');
    }

}
