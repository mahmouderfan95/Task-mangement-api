<?php

namespace App\Repositories\Contracts;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 10): LengthAwarePaginator;

    public function find(int $id): Task;

    public function create(int $projectId, array $data): Task;

    public function update(Task $task, array $data): Task;

    public function delete(Task $task): bool;
}
