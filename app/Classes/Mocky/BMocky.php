<?php

namespace App\Classes\Mocky;

use App\Interfaces\Classes\Mocky\MockyParseInterface;

class BMocky extends Mocky implements MockyParseInterface
{
    public function __construct()
    {
        parent::__construct('5d47f235330000623fa3ebf7');
    }

    /**
     * @param array $data
     * @return array
     */
    public function parse(array $data): array
    {
        foreach ($data as $key => $details){
            foreach ($details as $name => $detail){
                $data[$key] = [
                    'name' => $name,
                    'level' => $detail->level,
                    'estimated_duration' => $detail->estimated_duration,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        return $data;
    }
}
