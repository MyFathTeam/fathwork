<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class UserSearch
{
    public function execute(Request $request)
    {
        if (strlen($request->q) < 3) {
            return [];
        }

        $query = User::query()->isNotAdmin();

        return app(Pipeline::class)
            ->send($query)
            ->through([
                'App\QueryFilters\LikeMatch:q,name,email,username',
            ])->thenReturn()
            ->orderBy('name', 'asc')
            ->take(5)
            ->get();
    }
}
