<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected TaskService $service
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = $this->service->paginate(
            $request->only([
                'status',
                'priority',
                'search'
            ]),
            $request->integer('per_page', 10)
        );

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, int $project)
    {
        $task = $this->service->create(
            $project,
            $request->validated()
        );

        return $this->success(
            new TaskResource($task),
            'Task created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new TaskResource(
            $this->service->find($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = $this->service->find($id);

        $task = $this->service->update(
            $task,
            $request->validated()
        );

        return $this->success(
            new TaskResource($task),
            'Task Updated successfully',
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $task = $this->service->find($id);

        $this->service->delete($task);

        return $this->success(
            [],
            'Task created successfully',
            201
        );
    }
}
