<?php

namespace App\Http\Controllers;

use App\Mail\OpportunityAlert;
use App\Models\Opportunity;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the company's opportunities.
     */
    public function index(): View
    {
        $opportunities = Opportunity::where('user_id', Auth::id())->get();

        return view('company.index', compact('opportunities'));
    }

    /**
     * Display the form for creating a new opportunity.
     */
    public function create(): View
    {
        return view('company.create');
    }

    /**
     * Handle the form submission for creating a new opportunity.
     */
    public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'title' => ['required', 'min:6'],
            'category' => ['required'],
            'description' => ['required', 'min:60'],
            'img_upload' => ['required', 'mimes:png,jpg,jpeg'],
        ]);

        if ($request->has('img_upload')) {
            $file = $request->file('img_upload');
            $file_extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$file_extension;
            $path = 'uploads/opportunities';
            $file->move($path, $filename);
        }

        $opportunity = new Opportunity;
        $opportunity->user_id = Auth::id();
        $opportunity->title = $formFields['title'];
        $opportunity->category = $formFields['category'];
        $opportunity->description = $formFields['description'];
        $opportunity->img_url = url($path.'/'.$filename);
        $opportunity->status = 'Pending'; // default status when created
        $opportunity->closing_date = now()->addDays(30); // assuming 30 days is the required period
        $opportunity->save();

        return redirect()->route('company.index')->with('message', 'Opportunity has been Successfully Created!!');
    }

    /**
     * Publish an opportunity.
     */
    public function publish(int $id): RedirectResponse
    {
        $opportunity = Opportunity::where('id', $id)->where('user_id', Auth::id())->first();

        if (! $opportunity) {
            return redirect()->back()->withErrors('Opportunity not found.');
        }

        $opportunity->status = trim('Published');
        $opportunity->published_at = now();
        $opportunity->save();

        $students = User::where('user_type', 'student')
            ->where('category', $opportunity->category)
            ->get();

        foreach ($students as $student) {
            try {
                //code...
                $mailData = [
                    'studentName' => $student->name,
                    'opportunityTitle' => $opportunity->title,
                    'opportunityDetails' => $opportunity->description,
                ];
                Mail::to($student->email)->queue(new OpportunityAlert($mailData));
            } catch (Exception $e) {
                //throw $th;
                Log::error('Failed to send email to '.$student->email.': '.$e->getMessage());

            }

        }

        return redirect()->route('company.index')->with('message', 'Opportunity has been successfully published!');
    }

    /**
     * Unpublish an opportunity.
     */
    public function unpublish(int $id): RedirectResponse
    {
        $opportunity = Opportunity::where('id', $id)->where('user_id', Auth::id())->first();

        if (! $opportunity) {
            return redirect()->back()->withErrors('Opportunity not found.');
        }

        $opportunity->status = trim('Pending');
        $opportunity->published_at = now();
        $opportunity->save();

        return redirect()->route('company.index')->with('message', 'Opportunity has been unpublished successfully!');
    }

    /**
     * Delete an opportunity.
     */
    public function destroy(int $id): RedirectResponse
    {
        $opportunity = Opportunity::where('id', $id)->where('user_id', Auth::id())->first();

        if ($opportunity) {
            $opportunity->delete();

            return redirect()->route('company.index')->with('message', 'Opportunity successfully deleted.');
        } else {
            return redirect()->back()->withErrors('Opportunity not found.');
        }
    }

    /**
     * Display the form for editing an opportunity.
     */
    public function edit(Opportunity $opportunity): View
    {
        //   dd($opportunity);
        $categories = ['Volunteer', 'Internship', 'Job'];

        return view('company.edit', ['opportunity' => $opportunity, 'categories' => $categories]);
    }

    /**
     * Update an opportunity.
     */
    public function update(Request $request, Opportunity $opportunity): RedirectResponse
    {
        $formFields = $request->validate([
            'title' => ['required', 'min:6'],
            'category' => ['required'],
            'description' => ['required', 'min:60'],
            'img_upload' => ['mimes:png,jpg,jpeg'],
        ]);

        // Update the existing opportunity
        $opportunity->title = $formFields['title'];
        $opportunity->category = $formFields['category'];
        $opportunity->description = $formFields['description'];

        // Handle image upload
        if ($request->hasFile('img_upload')) {
            $file = $request->file('img_upload');
            $file_extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$file_extension;
            $path = 'uploads/opportunities';
            $file->move($path, $filename);
            $opportunity->img_url = url($path.'/'.$filename);
        }

        $opportunity->save();

        return redirect()->route('company.index')->with('message', 'Opportunity updated successfully!');
    }

    /**
     * Display a specific opportunity in JSON format.
     */
    public function show(int $id): JsonResponse
    {
        $opportunity = Opportunity::with('company')->findOrFail($id);

        return response()->json($opportunity);
    }
}
