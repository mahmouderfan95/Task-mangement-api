<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;

class ProjectService
{
    public function __construct(
        protected ProjectRepositoryInterface $repository
    ) {
    }

    public function paginate(int $perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    public function find(int $id): Project
    {
        return $this->repository->find($id);
    }

    public function create(array $data): Project
    {
        return $this->repository->create($data);
    }

    public function update(Project $project, array $data): Project
    {
        return $this->repository->update($project, $data);
    }

    public function delete(Project $project): bool
    {
        return $this->repository->delete($project);
    }
}
