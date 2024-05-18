<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        // Fetch only published opportunities
        $opportunities = Opportunity::where('status', 'Published')
                        ->latest('published_at')
                        ->homeSearchFilter(request(['search']))
                        ->simplePaginate(4);
        return view('welcome', compact('opportunities'));
    }
}


