<?php

namespace App\Http\Controllers\Frontend\Tasks;

use App\Http\Controllers\Controller;
use App\Services\Tasks\TaskService;
use App\Traits\APIResponseTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function index()
    {
        return view('home', $this->service->index());
    }
}
