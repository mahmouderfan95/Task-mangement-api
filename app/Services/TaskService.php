<?php
namespace App\Services;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $repository
    ) {
    }

    public function paginate(array $filters, int $perPage = 10)
    {
        return $this->repository->paginate($filters, $perPage);
    }

    public function find(int $id): Task
    {
        return $this->repository->find($id);
    }

    public function create(int $projectId, array $data): Task
    {
        return $this->repository->create($projectId, $data);
    }

    public function update(Task $task, array $data): Task
    {
        return $this->repository->update($task, $data);
    }

    public function delete(Task $task): bool
    {
        return $this->repository->delete($task);
    }
}
