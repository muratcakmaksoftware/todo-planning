<?php

namespace Database\Seeders;

use App\Interfaces\RepositoryInterfaces\Developers\DeveloperRepositoryInterface;
use App\Models\Developers\Developer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers = [
            [
                'name' => 'DEV1',
                'level' => 1,
                'estimated_duration' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DEV2',
                'level' => 2,
                'estimated_duration' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DEV3',
                'level' => 3,
                'estimated_duration' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DEV4',
                'level' => 4,
                'estimated_duration' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DEV5',
                'level' => 5,
                'estimated_duration' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        //firstOrCreate bilerek yapılmadı bu case projesi olduğundan bilginize.
        app()->make(DeveloperRepositoryInterface::class)->insert($developers);
    }
}
