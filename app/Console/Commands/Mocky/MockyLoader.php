<?php

namespace App\Console\Commands\Mocky;

use App\Classes\Mocky\AMocky;
use App\Classes\Mocky\BMocky;
use App\Classes\Mocky\MockyManager;
use Illuminate\Console\Command;

class MockyLoader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mocky:loader';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mocky API Loader';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * Mocky manager da birden fazla mocky sınıfı alabilecek şekilde yapabilirdim.
         * Biraz daha sade ve anlaşılır olması açısından bu şekilde ilerledim. AMocky Provider1, BMocky Provider2 dir
         * İki farklı API gibi davranarak bir sonraki API da CMocky yani provider 3 olarak ilerlenebilinecektir.
         */
        $AMocky = new AMocky();
        $mockyManager = new MockyManager($AMocky);
        $mockyManager->load();

        $BMocky = new BMocky();
        $mockyManager = new MockyManager($BMocky);
        $mockyManager->load();

        $this->info('Mocky Loaded!');
    }
}
