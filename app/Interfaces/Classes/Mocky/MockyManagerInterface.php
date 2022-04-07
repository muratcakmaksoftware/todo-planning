<?php

namespace App\Interfaces\Classes\Mocky;

interface MockyManagerInterface
{
    /**
     * @return mixed
     */
    public function getData(): mixed;

    /**
     * @return array
     */
    public function getParseData(): array;

    /**
     * @return array
     */
    public function load();
}
