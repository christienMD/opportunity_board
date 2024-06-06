<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpportunityResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class OpportunityController extends Controller
{

    use CanLoadRelationships;

    private array $relations = ['company'];

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {

        $query = $this->loadRelationships(Opportunity::query());

        return OpportunityResource::collection(
            $query->latest()->paginate()
        );
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): OpportunityResource
    {


        $opportunity = Opportunity::create([
            ...$request->validate([
                'title' => ['required', 'min:6'],
                'category' => ['required', 'string', 'in:job,internship,volunteer'],
                'description' => ['required', 'min:60'],
                // 'img_upload' => ['required', 'string'],
            ]),
            'user_id' => $request->user()->id
        ]);

        return new OpportunityResource($this->loadRelationships($opportunity));
    }

    /**
     * Display the specified resource.
     */
    public function show(Opportunity $opportunity): OpportunityResource
    {
        return new OpportunityResource($this->loadRelationships($opportunity));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opportunity $opportunity): OpportunityResource
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
    public function destroy(Opportunity $opportunity): Response
    {
        $opportunity->delete();

        return response(status: 204);
    }
}
