<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationMail;
use App\Models\Application;
use App\Models\Opportunity;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function index(): View
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
            ->searchFilter(request(['search']))
            ->get();

        return view('student.index', compact('opportunities'));
    }

    // show application form
    public function apply(int $id) : View
    {
        $opportunity = Opportunity::findOrFail($id);
        $user = auth()->user();
        return view('student.apply', compact('opportunity', 'user'));
    }

    
    public function store(Request $request): RedirectResponse
    {

        $userId = auth()->id();

       $formFields = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'message' => 'required|string',
            'cv_upload' => 'required|file|mimes:pdf|max:1014',
            'opportunity_id' => 'required|exists:opportunities,id'
        ]);

        // Store the CV file
        $path = 'uploads/cvs';
        $filename = null;

        if ($request->has('cv_upload')) {
            $file = $request->file('cv_upload');
            $file_extension = $file->getClientOriginalExtension();

            $filename = time() . '.' . $file_extension;
            $path = 'uploads/cvs';
            $file->move($path, $filename);
        }

        $cvPath = url($path . '/' . $filename);

        $application = new Application();
        $application->user_id = $userId;
        $application->opportunity_id = $formFields['opportunity_id'];
        $application->cv_path = $cvPath;
        $application->name = $formFields['name'];
        $application->phone_number = $formFields['phone_number'];
        $application->email = $formFields['email'];
        $application->message = $formFields['message'];

        $application->save();

        // Fetch the associated opportunity including the company
        $opportunity = Opportunity::with('company')->find($request->opportunity_id);

        if ($opportunity && $opportunity->company) {
            try {
                //code...
                $companyEmail = $opportunity->company->email;

                $emailContent = [
                    'message' => $request->message,
                    'studentName' => $request->name,
                    'opportunityTitle' => $opportunity->title
                ];

                Mail::to($companyEmail)->queue(new ApplicationMail($emailContent));
            } catch (Exception $e) {
                Log::error('Failed to send email to ' . $companyEmail . ': ' . $e->getMessage());

                return back()->with('error', 'Failed to send the email to ' . $companyEmail . '. Please try again.');
            }


            // Redirect based on authentication status
            if (Auth::check()) {
                return redirect()->route('student.index')->with('message', 'Your application has been submitted successfully! We will get back to you shortly.');
            } else {
                return redirect()->route('student.success');
            }
        } else {
            return redirect()->back()->with('error', 'Opportunity or company not found.');
        }
    }

    // show application success page
    public function success(): View
    {
        return view('student.success');
    }

}
