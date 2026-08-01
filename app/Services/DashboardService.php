<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;

class DashboardService
{
    public function statistics(): array
    {
        $user = auth()->user();

        $projectIds = $user->projects()->pluck('id');

        return [

            'total_projects' => $user->projects()->count(),

            'active_projects' => $user->projects()
                ->where('status', 'active')
                ->count(),

            'total_tasks' => Task::whereIn(
                'project_id',
                $projectIds
            )->count(),

            'completed_tasks' => Task::whereIn(
                'project_id',
                $projectIds
            )->where('status', 'done')
                ->count(),

            'pending_tasks' => Task::whereIn(
                'project_id',
                $projectIds
            )->where('status', '!=', 'done')
                ->count(),

            'overdue_tasks' => Task::whereIn(
                'project_id',
                $projectIds
            )
                ->where('status', '!=', 'done')
                ->whereDate('due_date', '<', now())
                ->count(),
        ];
    }
}
