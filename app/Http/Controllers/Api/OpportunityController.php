<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpportunityRequest;
use App\Http\Requests\UpdateOpportunityRequest;
use App\Http\Resources\OpportunityResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Opportunity;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class OpportunityController extends Controller
{

    use CanLoadRelationships, AuthorizesRequests;

    private array $relations = ['company'];

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Opportunity::class, 'opportunity');
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
        $query->orderBy('published_at', $sortOrder);
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
    public function store(StoreOpportunityRequest $request): OpportunityResource
    {

        $validatedFields = $request->validated();

        $opportunity = Opportunity::create([

            'title' => $validatedFields['title'],
            'category' => $validatedFields['category'],
            'description' => $validatedFields['description'],
            // 'img_upload' => $validatedFields['img_upload'],

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
    public function update(UpdateOpportunityRequest $request, Opportunity $opportunity): OpportunityResource
    {

        Log::info('Attempting to authorize update for opportunity ID: ' . $opportunity->id . ' by user ID: ' . auth()->id());
        
        $this->authorize('update', $opportunity);

        $validatedFields = $request->validated();

        $opportunity->update([
            'title' => $validatedFields['title'],
            'category' => $validatedFields['category'],
            'description' => $validatedFields['description'],
            'img_upload' => $validatedFields['img_upload'],
        ]);

        return new OpportunityResource($this->loadRelationships($opportunity));
    }

    /**
     * published an opportunity.
     */
    public function publish(int $id): JsonResponse
    {
        $opportunity = Opportunity::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$opportunity) {
            return response()->json(
                ['message' => 'Opportunity not found.'],
                404
            );
        }

        // Check if the opportunity is already published
        if ($opportunity->status === 'Published') {
            return response()->json(
                ['message' => 'Opportunity is already published.'],
                400
            );
        }

        $opportunity->status = 'Published';
        $opportunity->published_at = now();
        $opportunity->save();

        return response()->json(['message' => 'Opportunity published successfully.'], 200);
    }


    /**
     * Unpublish a published opportunity.
     */
    public function unpublish(int $id): JsonResponse
    {
        $opportunity = Opportunity::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$opportunity) {
            return response()->json(
                ['message' => 'Opportunity not found.'],
                404
            );
        }

        // Check if the opportunity is not published
        if ($opportunity->status !== 'Published') {
            return response()->json(
                ['message' => 'Opportunity is not currently published.'],
                400
            );
        }

        $opportunity->status = 'Pending';
        $opportunity->published_at = null;
        $opportunity->save();

        return response()->json(['message' => 'Opportunity unpublished successfully.'], 200);
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
