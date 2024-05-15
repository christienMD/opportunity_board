<?php

namespace App\Http\Controllers;

use App\Mail\OpportunityAlert;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    // show the home page
    public function home()
    {
        $opportunities = Opportunity::where('user_id', Auth::id())->get();
        return view('company_home', compact('opportunities'));
    }


    // show create form
    public function create()
    {
        return view('company.create');
    }



    // save opportunities in the database
    public function save(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:6'],
            'category' => ['required'],
            'description' => ['required', 'min:60'],
            'img_upload' => ['required', 'mimes:png,jpg,jpeg']
        ]);

        if ($request->has('img_upload')) {
            $file = $request->file('img_upload');
            $file_extension = $file->getClientOriginalExtension();

            $filename = time() . '.' . $file_extension;
            $path = 'uploads/opportunities';
            $file->move($path, $filename);
        }

        $opportunity = new Opportunity;
        $opportunity->user_id = Auth::id();
        $opportunity->title = $request->input('title');
        $opportunity->category = $request->input('category');
        $opportunity->description = $request->input('description');
        $opportunity->img_url = url($path . '/' . $filename);
        $opportunity->status = 'Pending'; // default status when created
        $opportunity->closing_date = now()->addDays(30); // assuming 30 days is the required period
        $opportunity->save();

        return redirect()->route('company_home')->with('message', 'Opportunity has been Successfully Created!!');
    }



    // publish opportunity
    public function publish($id)
    {
        $opportunity = Opportunity::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$opportunity) {
            return redirect()->back()->withErrors('Opportunity not found.');
        }

        $opportunity->status = trim('Published');
        $opportunity->published_at = now();
        $opportunity->save();

        $students = User::where('user_type', 'student')
                  ->where('category', $opportunity->category)
                  ->get();

        foreach ($students as $student) {
            $mailData = [ // Adjust mail data as per your requirements
                    'studentName' => $student->name,
                    'opportunityTitle' => $opportunity->title,
                    'opportunityDetails' => $opportunity->details,
                ];
            Mail::to($student->email)->send(new OpportunityAlert($mailData));
        }
      
        return redirect()->route('company_home')->with('message', 'Opportunity has been successfully published!');
    }

    // delete opportunities
    public function delete($id)
    {
        $opportunity = Opportunity::where('id', $id)->where('user_id', Auth::id())->first();

        if ($opportunity) {
            $opportunity->delete();
            return redirect()->route('company_home')->with('message', 'Opportunity successfully deleted.');
        } else {
            return redirect()->back()->withErrors('Opportunity not found.');
        }
    }

   // show edit form
   public function edit(Opportunity $opportunity) {
        //   dd($opportunity);
        $categories = ['Volunteer', 'Internship', 'Job'];
      return view('company.edit', ['opportunity' => $opportunity, 'categories' => $categories]);
   }

   // update opportunities
    public function update(Request $request, Opportunity $opportunity)
    {
        $request->validate([
            'title' => ['required', 'min:6'],
            'category' => ['required'],
            'description' => ['required', 'min:60'],
            'img_upload' => ['mimes:png,jpg,jpeg']
        ]);

        // Update the existing opportunity
        $opportunity->title = $request->input('title');
        $opportunity->category = $request->input('category');
        $opportunity->description = $request->input('description');

        // Handle image upload
        if ($request->hasFile('img_upload')) {
            $file = $request->file('img_upload');
            $file_extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $file_extension;
            $path = 'uploads/opportunities';
            $file->move($path, $filename);
            $opportunity->img_url = url($path . '/' . $filename);
        }

        $opportunity->save();

        return redirect()->route('company_home')->with('message', 'Opportunity updated successfully!');
    }

}
