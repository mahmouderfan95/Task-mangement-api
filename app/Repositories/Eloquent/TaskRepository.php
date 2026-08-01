<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return Task::query()
            ->whereHas('project', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->status($filters['status'] ?? null)
            ->priority($filters['priority'] ?? null)
            ->search($filters['search'] ?? null)
            ->latest()
            ->paginate($perPage);
    }

    public function find(int $id): Task
    {
        return Task::query()
            ->whereHas('project', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail($id);
    }

    public function create(int $projectId, array $data): Task
    {
        $project = auth()->user()
            ->projects()
            ->findOrFail($projectId);

        return $project->tasks()->create($data);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task->refresh();
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}
