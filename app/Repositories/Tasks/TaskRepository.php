<?php

namespace App\Repositories\Tasks;

use App\Http\Controllers\Controller;
use App\Interfaces\RepositoryInterfaces\Tasks\TaskRepositoryInterface;
use App\Models\Tasks\Task;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function getTasks($orderBy = 'ASC')
    {
        return $this->model->orderBy('level', $orderBy)->orderBy('estimated_duration', $orderBy)->get();
    }
}
