<?php

namespace Albert\Waf\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Albert\Waf\Waf
 */
class Waf extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Albert\Waf\Waf::class;
    }
}
