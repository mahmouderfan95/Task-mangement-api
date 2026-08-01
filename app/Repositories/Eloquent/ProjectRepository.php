<?php

namespace App\Repositories\Eloquent;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return auth()
            ->user()
            ->projects()
            ->withCount('tasks')
            ->latest()
            ->paginate($perPage);
    }

    public function find(int $id): Project
    {
        return auth()
                ->user()
                ->projects()
                ->with('tasks')
                ->withCount('tasks')
                ->findOrFail($id);
    }

    public function create(array $data): Project
    {
        return auth()
            ->user()
            ->projects()
            ->create($data);
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);

        return $project->refresh();
    }

    public function delete(Project $project): bool
    {
        return $project->delete();
    }
}
