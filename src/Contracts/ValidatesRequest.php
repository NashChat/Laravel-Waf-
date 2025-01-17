<?php

namespace Albert\Waf\Contracts;

use Illuminate\Http\Request;

interface ValidatesRequest
{
    public function requestIsValid(Request $request): bool;
}
