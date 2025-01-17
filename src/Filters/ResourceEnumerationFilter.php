<?php

namespace Albert\Waf\Filters;

use Albert\Waf\Contracts\ValidatesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ResourceEnumerationFilter implements ValidatesRequest
{
    public function requestIsValid(Request $request): bool
    {
        $expressions = new Collection(explode(
            PHP_EOL,
            $this->playload('resource_enumeration.txt')
        ));

        if ($expressions->contains($request->getRequestUri())) {
            return false;
        }

        return true;
    }

    protected function playload($filename): string
    {
        $path = realpath(__DIR__.'/../../payloads');

        return file_get_contents($path.'/'.$filename);
    }
}
