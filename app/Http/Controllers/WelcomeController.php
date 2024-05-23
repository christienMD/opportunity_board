<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    /**
     * Display the welcome page with a list of published opportunities.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function welcome(): View
    {
        // Fetch only published opportunities
        $opportunities = Opportunity::where('status', 'Published')
                        ->latest('published_at')
                        ->homeSearchFilter(request(['search']))
                        ->simplePaginate(4);
        return view('welcome', compact('opportunities'));
    }
}


