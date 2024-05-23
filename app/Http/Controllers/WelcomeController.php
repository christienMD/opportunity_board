<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page with a list of published opportunities.
     */
    public function welcome(): View
    {
        // Fetch only published opportunities
        $opportunities = Opportunity::where('status', 'Published')
            ->latest('published_at')
            ->homeSearchFilter(request(['search']))
            ->simplePaginate(3);

        return view('welcome', compact('opportunities'));
    }
}
