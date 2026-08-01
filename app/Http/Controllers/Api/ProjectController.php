<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectService $projectService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = $this->projectService->paginate(
            $request->integer('per_page', 10)
        );

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->projectService->create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Project created successfully',
            'data' => new ProjectResource($project),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ProjectResource
    {
        return new ProjectResource(
            $this->projectService->find($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateProjectRequest $request,
        int $id
    ): JsonResponse {

        $project = $this->projectService->find($id);

        $project = $this->projectService->update(
            $project,
            $request->validated()
        );

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => new ProjectResource($project),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $project = $this->projectService->find($id);

        $this->projectService->delete($project);

        return response()->json([
            'message' => 'Project deleted successfully',
        ], 200);
    }
}
