<?php

namespace App\Interfaces\RepositoryInterfaces\Developers;

interface DeveloperRepositoryInterface
{
    public function getDevelopers($orderBy = 'ASC');
}
