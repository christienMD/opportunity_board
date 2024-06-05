<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpportunityResource;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OpportunityResource::collection(Opportunity::with('company')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $opportunity = Opportunity::create([
            ...$request->validate([
                'title' => ['required', 'min:6'],
                'category' => ['required', 'string', 'in:job,internship,volunteer'],
                'description' => ['required', 'min:60'],
                // 'img_upload' => ['required', 'string'],
            ]),
            'user_id' => 1
        ]);

        return new OpportunityResource($opportunity);
    }

    /**
     * Display the specified resource.
     */
    public function show(Opportunity $opportunity)
    {
        return new OpportunityResource($opportunity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opportunity $opportunity)
    {
        $opportunity->update(
            $request->validate([
                'title' => ['sometimes', 'min:6'],
                'category' => ['sometimes', 'string', 'in:job,internship,volunteer'],
                'description' => ['sometimes', 'min:60'],
                'img_upload' => ['sometimes', 'string'],
            ]),
        );

        return new OpportunityResource($opportunity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();

        return response(status: 204);
    }
}
