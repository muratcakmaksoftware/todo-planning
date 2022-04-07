<?php

namespace App\Services\Developers;

use App\Http\Controllers\Controller;
use App\Interfaces\RepositoryInterfaces\Developers\DeveloperRepositoryInterface;

class DeveloperService extends Controller
{
    /**
     * @var DeveloperRepositoryInterface
     */
    private DeveloperRepositoryInterface $repository;

    /**
     * @param DeveloperRepositoryInterface $repository
     */
    public function __construct(DeveloperRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
