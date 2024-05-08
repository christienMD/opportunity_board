<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function home()
    {
       // Redirect to login if the user is not authenticated
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $userCategory = Auth::user()->category;

        // Fetching published opportunities that match the user's category
        $opportunities = Opportunity::where('category', $userCategory)
            ->where('status', 'Published')
            ->latest('published_at')  // showing the latest opportunities first
            ->get();

        return view('student_home', compact('opportunities'));
    }
}
