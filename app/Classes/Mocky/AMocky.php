<?php

namespace App\Classes\Mocky;

use App\Interfaces\Classes\Mocky\MockyParseInterface;

class AMocky extends Mocky implements MockyParseInterface
{
    public function __construct()
    {
        parent::__construct('5d47f24c330000623fa3ebfa');
    }

    /**
     * @param array $data
     * @return array
     */
    public function parse(array $data): array
    {
        foreach ($data as $key => $row){
            $data[$key] = [
                'name' => $row->id,
                'level' => $row->zorluk,
                'estimated_duration' => $row->sure,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }
}
