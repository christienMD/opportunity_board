<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    // show the home page
    public function home()
    {
        $opportunities = Opportunity::where('user_id', Auth::id())->get();
        return view('company_home', compact('opportunities'));
    }


    // create 
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

}
