<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Services\DashboardService;
class DashboardController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected DashboardService $service
    ) {
    }

    public function index()
    {
        return $this->success(
            $this->service->statistics(),
            'Dashboard statistics'
        );
    }
}
