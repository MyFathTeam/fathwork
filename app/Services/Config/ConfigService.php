<?php

namespace App\Services\Config;

use App\Concerns\LocalStorage;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;

class ConfigService
{
    use LocalStorage;

    public function getPreRequisite(Request $request)
    {
        $types = snake_case($request->type);

        $types = ! is_array($types) ? explode(',', $types) : $types;

        $data = ListHelper::getLists($types);

        if (in_array('countries', $types)) {
            $data['countries'] = ListHelper::getList('countries', 'code');
        }

        if (in_array('currencies', $types)) {
            $data['currencies'] = ListHelper::getList('currencies', 'name');
        }

        if (in_array('timezones', $types)) {
            $data['timezones'] = ListHelper::getList('timezones');
        }

        if (in_array('locales', $types)) {
            $data['locales'] = $this->getKey('locales');
        }

        return $data;
    }
}
