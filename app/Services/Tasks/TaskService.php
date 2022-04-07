<?php

namespace App\Services\Tasks;

use App\Classes\Tasks\TaskAssignor;
use App\Http\Controllers\Controller;
use App\Interfaces\RepositoryInterfaces\Developers\DeveloperRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\Tasks\TaskRepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class TaskService extends Controller
{
    /**
     * @var TaskRepositoryInterface
     */
    private TaskRepositoryInterface $repository;

    /**
     * @param TaskRepositoryInterface $repository
     */
    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     * @throws BindingResolutionException
     */
    public function index(): array
    {
        /**
         * Developer’ların haftalık 45 saat çalıştığı varsayılarak, en kısa sürede işlerin bitmesini sağlayan bir algoritma ile
         * haftalık developer bazında iş yapma programını ve işin minimum toplam kaç haftada biteceğini ekrana basacak bir ara yüz hazırlanmalı.
         */
        //Bir developer Haftalık 45 saat çalışıyorsa 45(saat)/5(gün) = 9 saat günlük çalışıyor demektir.

        /**
         * Developers ve Tasks bilgilerindeki sorgularda orderBy sadece performans amaçlıdır.
         */
        $developers = app()->make(DeveloperRepositoryInterface::class)->getDevelopers()->toArray(); //Developers seviye ve süre bakımından sıralama yapıldı.
        $tasks = $this->repository->getTasks()->toArray(); //İş sırasını seviye ve süre bakımından kolaydan zora şeklinde ayarlandı.

        /**
         * İlerlenen senaryo:
         * Her geliştiricinin seviyesine göre eşit ağırlıkta task dağıtımını sağlamak.
         * Bunu sağlayabilmek için seviye seviye dağıtım yapılacak şekilde ilerlendi ve aynı zamanda esneklik olarak
           boş saatleri doldurabilmek için seviye kontrolü olmadan da atamalar gerçekleştirildi.
         * Günlük tamamlanamayan örneğin 12 saatlik task'ın kopyalanarak 12-9=3 2 adet taska bölünmüştür.
           Kısacası tasklar çalışma saatlerine uyarlanmıştır.
         */

        $taskAssignor = new TaskAssignor($developers, $tasks);
        return [
            'developerTasks' => $taskAssignor->assign(),
            'endWeek' => $taskAssignor->getEndWeek(),
            'dayLimit' => $taskAssignor->getDayLimit(),
            'dailyWorkHours' => $taskAssignor->getDailyWorkHours()
        ];
    }

}
