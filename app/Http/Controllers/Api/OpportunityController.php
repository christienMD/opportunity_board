<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpportunityResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Opportunity;
use Carbon\Carbon;
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
    public function index(Request $request): AnonymousResourceCollection
    {

        $query = $this->loadRelationships(Opportunity::query());

        // Filter by text (title, description)
        if ($request->filled('search')) {
            $searchText = $request->input('search');
            $query->where(function ($q) use ($searchText) {
                $q->where('title', 'like', '%' . $searchText . '%')
                    ->orWhere('description', 'like', '%' . $searchText . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Sort by date posted
        $sortOrder = $request->input('sort', 'desc');
        $query->orderBy('created_at', $sortOrder);
        /**
         * Filter by start_date and end_date 
         * 
         * Check if both start_date and end_date are provided
         * 
         * If both start_date and end_date are provided, the opportunities 
         * created within this range are returned.
         */
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);


            /**
             * Check if only start_date is provided
             * 
             * If only start_date is provided, opportunities created after this date are returned.
             */
        } elseif ($request->filled('start_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $query->where('created_at', '>=', $startDate);

            /**
             * Check if only end_date is provided
             * 
             * If only end_date is provided, opportunities created before this date are returned.
             */
        } elseif ($request->filled('end_date')) {
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
            $query->where('created_at', '<=', $endDate);
        }


        return OpportunityResource::collection(
            $query->latest()->paginate()
        );
    }



    /**
     * Store a newly created resource in the database.
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
