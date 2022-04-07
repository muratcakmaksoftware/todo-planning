<?php

namespace App\Http\Controllers\Backend\Tasks;

use App\Http\Controllers\Controller;
use App\Services\Tasks\TaskService;
use App\Traits\APIResponseTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    use APIResponseTrait;

    /**
     * @var TaskService
     */
    private TaskService $service;

    /**
     * @param TaskService $service
     */
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index()
    {
        return $this->responseSuccess($this->service->index());
    }
}
