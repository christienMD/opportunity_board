<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpportunityResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{

    use CanLoadRelationships;

    private array $relations = ['company'];
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $query = $this->loadRelationships(Opportunity::query());

        return OpportunityResource::collection(
            $query->latest()->paginate()
        );
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
            'user_id' => 2
        ]);

        return new OpportunityResource($this->loadRelationships($opportunity));
    }

    /**
     * Display the specified resource.
     */
    public function show(Opportunity $opportunity)
    {
        return new OpportunityResource($this->loadRelationships($opportunity));
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

        return new OpportunityResource($this->loadRelationships($opportunity));
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
