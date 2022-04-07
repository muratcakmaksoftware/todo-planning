<?php

namespace App\Http\Controllers\Backend\Developers;

use App\Http\Controllers\Controller;
use App\Services\Developers\DeveloperService;
use App\Traits\APIResponseTrait;

class DeveloperController extends Controller
{
    use APIResponseTrait;

    /**
     * @var DeveloperService
     */
    private DeveloperService $service;

    /**
     * @param DeveloperService $service
     */
    public function __construct(DeveloperService $service)
    {
        $this->service = $service;
    }
}
