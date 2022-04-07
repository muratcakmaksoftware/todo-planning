<?php

namespace App\Repositories\Developers;

use App\Interfaces\RepositoryInterfaces\Developers\DeveloperRepositoryInterface;
use App\Models\Developers\Developer;
use App\Repositories\BaseRepository;

class DeveloperRepository extends BaseRepository implements DeveloperRepositoryInterface
{
    public function __construct(Developer $model)
    {
        parent::__construct($model);
    }

    public function getDevelopers($orderBy = 'ASC')
    {
        return $this->model->orderBy('level', $orderBy)->orderBy('estimated_duration', $orderBy)->get();
    }
}
