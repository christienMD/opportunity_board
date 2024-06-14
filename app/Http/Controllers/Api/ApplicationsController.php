<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{

    private array $relations = ['user'];

    use CanLoadRelationships;
    function index()
    {
        $query = $this->loadRelationships(Application::query());
        return ApplicationResource::collection(
            $query->latest()->paginate()
        );
    }

    function store(SubmitApplicationRequest $request)
    {
        $validatedFields = $request->validated();

        $application = Application::create([
            'user_id' => auth()->id(),
            'name' => $validatedFields['name'],
            'email' => $validatedFields['email'],
            'phone_number' => $validatedFields['phone_number'],
            'message' => $validatedFields['message'],
            // 'cv_path' => $request->file('cv_upload')->store('cvs'), // Store the CV file
            'opportunity_id' => $validatedFields['opportunity_id'],
        ]);

        return new ApplicationResource($this->loadRelationships($application));
    }
}
