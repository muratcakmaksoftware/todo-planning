<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

if(!function_exists('translation')){

    /**
     * @param $languageFileEnum
     * @param $key
     * @param array $data
     * @return array|Application|Translator|string|null
     */
    function translation($languageFileEnum, $key, array $data = []): array|string|Translator|Application|null
    {
        return __($languageFileEnum.'.'.$key, $data);
    }
}
