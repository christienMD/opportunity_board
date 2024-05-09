<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
            ->latest('published_at')
            ->get();

        return view('student_home', compact('opportunities'));
    }

    // show application form
    public function showApplyForm($opportunityId) {
        $opportunity = Opportunity::findOrFail($opportunityId);
        return view('components.apply_form', compact('opportunity'));
    }



    public function apply(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'message' => 'required|string',
            'cv_upload' => 'required|file|mimes:pdf|max:6144',
            'opportunity_id' => 'required|exists:opportunities,id'
        ]);

        // Store the CV file
        $cvPath = $request->file('cv_upload')->store('public/cvs');

        $application = new Application([
            'user_id' => auth()->id(),
            'opportunity_id' => $request->opportunity_id,
            'cv_path' => $cvPath,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'message' => $request->message
        ]);
        $application->save();

        return redirect()->route('student_home')->with('message', 'Your application has been submitted successfully! We will get back to you shortly.');
    }

}
