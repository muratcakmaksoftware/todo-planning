<?php

namespace App\Interfaces\Classes\Tasks;

interface TaskAssignorInterface
{
    /**
     * @return int
     */
    public function getEndWeek(): int;

    /**
     * @return int
     */
    public function getDayLimit(): int;

    /**
     * @return int
     */
    public function getDailyWorkHours(): int;

    /**
     * @param $hour
     * @return mixed
     */
    public function setDailyWorkHours($hour): void;

    /**
     * @return array
     */
    public function assign(): array;
}
