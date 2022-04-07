<?php

namespace App\Classes\Mocky;

use App\Interfaces\Classes\Mocky\MockyInterface;

class Mocky implements MockyInterface
{
    /**
     * @var string
     */
    protected string $code;

    /**
     * API Code
     *
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

}
