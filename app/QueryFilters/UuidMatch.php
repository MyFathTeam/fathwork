<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Str;

class UuidMatch
{
    public function handle($request, Closure $next, ...$options)
    {
        $search = request()->query('uuid');

        if (! $search) {
            return $next($request);
        }

        $uuids = Str::toArray($search);

        $builder = $next($request);

        return $builder->when($uuids, function ($q, $uuids) {
            $q->whereIn('uuid', $uuids);
        });
    }
}
