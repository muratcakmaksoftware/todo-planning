<?php

namespace App\Interfaces\RepositoryInterfaces\Tasks;

interface TaskRepositoryInterface
{
    public function getTasks($orderBy = 'ASC');
}
