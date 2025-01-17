<?php

namespace Albert\Waf;

use Albert\Waf\Contracts\ValidatesRequest;
use Albert\Waf\Models\Ban;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class Waf
{
    public function banIpUntil(string $ip, Carbon $bannedUntil): void
    {
        $ban = new Ban;
        $ban->ip_address = $ip;
        $ban->banned_until = $bannedUntil;
        $ban->save();
    }

    public function ipHasBan(string $ip): bool
    {
        if (! $ban = Ban::where('ip_address', $ip)->latest('banned_until')->first()) {
            return false;
        }

        if (! $ban->banned_until) {
            return true;
        }

        return $ban->banned_until->gt(Carbon::now());
    }

    public function requestIsAllowed(Request $request): bool
    {
        if ($this->ipHasBan($request->ip())) {
            return false;
        }

        foreach ($this->getFilters() as $filter) {
            if (! ($filter = new $filter) instanceof ValidatesRequest) {
                continue;
            }

            if (! $filter->requestIsValid($request)) {
                return false;
            }
        }

        return true;
    }

    protected function getFilters()
    {
        return Config::get('waf.filters', []);
    }
}
