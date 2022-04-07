<?php

namespace App\Interfaces\Classes\Mocky;

interface MockyParseInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function parse(array $data): array;
}
