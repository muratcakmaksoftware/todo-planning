<?php

namespace App\Classes\Tasks;

use App\Enums\Tasks\TaskLevel;
use App\Interfaces\Classes\Tasks\TaskAssignorInterface;

class TaskAssignor implements TaskAssignorInterface
{
    private array $tasks = [];
    private array $developers = [];

    private int $week = 1; //hafta limitsiz olarak artar
    private int $day = 1;
    private int $dayLimit = 5; //hafta içi maksimum çalışılacak olan gün sayısıdır.

    private int $dailyWorkHours = 9; //günlük çalışma saati
    private int $dailyHours = 0; //atanacak olan görevlerin saat bilgilerinin toplanması içindir.

    /**
     * @param $developers
     * @param $tasks
     */
    public function __construct($developers, $tasks)
    {
        $this->tasks = $tasks;
        $this->developers = $developers;
    }

    /**
     * Tasks bitiş haftasının bilgisini döner.
     * @return int
     */
    public function getEndWeek(): int
    {
        return $this->week;
    }

    /**
     * Hafta içi maksimum çalışma gün sayısını döner.
     * @return int
     */
    public function getDayLimit(): int
    {
        return $this->dayLimit;
    }

    /**
     * Günlük çalışma saat bilgisini döner.
     * @return int
     */
    public function getDailyWorkHours(): int
    {
        return $this->dailyWorkHours;
    }

    /**
     * Günlük çalışma saatini değiştirir.
     * @param $hour
     * @return void
     */
    public function setDailyWorkHours($hour): void
    {
        $this->dailyWorkHours = $hour;
    }

    /**
     * Developerlara görev atama işlemini yapar.
     * @return array
     */
    public function assign(): array
    {
        $this->taskDailyDivider(); //Taskların günlük çalışma saatlerine uyarlanması.
        while (true) { //Gün ve hafta atlatmak için sonsuz döngüdür. Task atama bitiminde sonlanır.

            foreach ($this->developers as $devIndex => $developer) {
                while (true) { //Bir developerin günlük saatlerini doldurmak için sonsuz döngüdür
                    $taskIndex = $this->findTask($devIndex, $developer); //developera uygun taskı bulur.
                    if (isset($taskIndex)) { // gorev bulunduysa developera atanmasi
                        $this->developers[$devIndex]['weeks'][$this->week]['days'][$this->day]['tasks'][] = $this->tasks[$taskIndex];
                        $this->removeAssignedTask($taskIndex); //atanan gorevin bellekten silinmesi.
                    } else {
                        $this->dailyHours = 0; //bir developer icin gunluk atama tamamlandi
                        break;
                    }
                }
            }

            if (count($this->tasks) == 0) { //Tüm tasklar atandı mı ?
                break;
            }

            if ($this->day == $this->dayLimit) { //hafta dolmuş mu ?
                $this->week += 1; //hafta atlanir
                $this->day = 1;
            } else {
                $this->day++; //diger gune gecilir
            }
        }

        return $this->developers;
    }

    /**
     * Developer'a göre task bulur ve döner.
     * @param $devIndex
     * @param $developer
     * @param bool $flexible
     * @return int|null
     */
    private function findTask($devIndex, $developer, bool $flexible = false): int|null
    {
        foreach ($this->tasks as $taskIndex => $task) {
            if ($flexible) { //Level veya süre kontrolü olmadan günün boş saatini doldurmak amaçlı task atanır.
                $hoursRemaining = $this->dailyWorkHours - $this->dailyHours;
                if (($hoursRemaining + $task['estimated_duration']) <= $this->dailyWorkHours) {
                    $this->dailyHours += $task['estimated_duration'];
                    return $taskIndex;
                }
            } else { //Developerin level bilgilerine göre task atama işlemleri yapılır.
                if (($developer['level'] >= TaskLevel::LEVEL_1 && $developer['level'] <= TaskLevel::LEVEL_2) && ($task['level'] >= TaskLevel::LEVEL_1 && $task['level'] <= TaskLevel::LEVEL_2)) {
                    if ($this->checkTaskEstimatedDuration($task['estimated_duration'])) {
                        return $taskIndex;
                    }
                } else if (($developer['level'] >= TaskLevel::LEVEL_2 && $developer['level'] <= TaskLevel::LEVEL_3) && ($task['level'] >= TaskLevel::LEVEL_2 && $task['level'] <= TaskLevel::LEVEL_3)) {
                    if ($this->checkTaskEstimatedDuration($task['estimated_duration'])) {
                        return $taskIndex;
                    }
                } else if (($developer['level'] >= TaskLevel::LEVEL_3 && $developer['level'] <= TaskLevel::LEVEL_4) && ($task['level'] >= TaskLevel::LEVEL_3 && $task['level'] <= TaskLevel::LEVEL_4)) {
                    if ($this->checkTaskEstimatedDuration($task['estimated_duration'])) {
                        return $taskIndex;
                    }
                } else if (($developer['level'] >= TaskLevel::LEVEL_4 && $developer['level'] <= TaskLevel::LEVEL_5) && ($task['level'] >= TaskLevel::LEVEL_4 && $task['level'] <= TaskLevel::LEVEL_5)) {
                    if ($this->checkTaskEstimatedDuration($task['estimated_duration'])) {
                        return $taskIndex;
                    }
                } else { //$developer['level'] >= 5 && $task['level'] >= 5
                    if ($this->checkTaskEstimatedDuration($task['estimated_duration'])) {
                        return $taskIndex;
                    }
                }
            }
        }

        if ($flexible == false && $this->dailyHours < $this->dailyWorkHours) { //Esnek task kontrolü yapılmamışsa ve günlük saat task olarak tamamlanmamışsa kontrol edilir.
            return $this->findTask($devIndex, $developer, true);
        }
        return null;
    }

    /**
     * Kontrol edilen task'ın eklendiği zaman günlük çalışma saatini geçiyor mu diye kontrol eder ve geçmiyorsa ekleme işlemi yapılır.
     * @param $estimatedDuration
     * @return bool
     */
    private function checkTaskEstimatedDuration($estimatedDuration): bool
    {
        if (($this->dailyHours + $estimatedDuration) <= $this->dailyWorkHours) {
            $this->dailyHours += $estimatedDuration;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Amacı günlük çalışma saatti dışında kalan task ların bölünerek çoğaltılmasıdır.
     * @return void
     */
    private function taskDailyDivider()
    {
        foreach ($this->tasks as $taskIndex => $task) {
            if ($task['estimated_duration'] > $this->dailyWorkHours) { //Eğer günlük iş saatini aşan bir task ise bölünme işlemi gerçekleşir.
                while (true) {
                    $estimatedDuration = $task['estimated_duration'];
                    if ($estimatedDuration == 0) { //Bölünmede saat sıfıra eşitlendiyse.
                        $this->removeAssignedTask($taskIndex);
                        break;
                    } else if ($estimatedDuration >= 1 && $estimatedDuration <= $this->dailyWorkHours) { //tek günlük task kaldıysa direk atama yapilir
                        $this->tasks[] = $task;
                        $this->removeAssignedTask($taskIndex);
                        break;
                    } else {
                        $task['estimated_duration'] -= $this->dailyWorkHours;
                        $this->tasks[] = $task;
                    }
                }
            }
        }
    }

    /**
     * Atanmış task'ı silme işlemi yapar.
     * @param $taskIndex
     * @return void
     */
    private function removeAssignedTask($taskIndex)
    {
        unset($this->tasks[$taskIndex]);
    }
}
