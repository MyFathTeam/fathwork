<?php

namespace App\Actions\Config;

use App\Concerns\LocalStorage;
use App\Helpers\ListHelper;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class StoreSystemConfig
{
    use LocalStorage;

    public static function handle(): array
    {
        $input = request()->validate([
            'enable_maintenance_mode' => 'sometimes|boolean',
            'maintenance_mode_message' => 'required_if:enable_maintenance_mode,true|max:200',
            'timezone' => 'sometimes|required',
            'date_format' => 'sometimes|required',
            'time_format' => 'sometimes|required',
            'locale' => 'sometimes|required',
            'currency' => 'sometimes|required',
            'currencies' => 'sometimes|required|array|min:1',
            'per_page' => 'sometimes|required|integer|min:5|max:1000',
            'footer_credit' => 'nullable',
            'show_version_number' => 'sometimes|boolean',
            'enable_dark_theme' => 'sometimes|boolean',
            'enable_mini_sidebar' => 'sometimes|boolean',
        ], [
            'maintenance_mode_message.required_if' => __('validation.required', ['attribute' => __('config.system.props.maintenance_mode_message')]),
        ], [
            'enable_maintenance_mode' => __('config.system.props.maintenance_mode'),
            'maintenance_mode_message' => __('config.system.props.maintenance_mode_message'),
            'timezone' => __('config.system.props.timezone'),
            'enable_dark_theme' => __('global.enable', ['attribute' => __('config.system.props.dark_theme')]),
            'enable_mini_sidebar' => __('global.enable', ['attribute' => __('config.system.props.mini_sidebar')]),
            'date_format' => __('config.system.props.date_format'),
            'time_format' => __('config.system.props.time_format'),
            'locale' => __('config.system.props.locale'),
            'currency' => __('config.system.props.currency'),
            'per_page' => __('config.system.props.page_length'),
            'footer_credit' => __('config.system.props.footer_credit'),
            'show_version_number' => __('config.system.props.show_version_number'),
        ]);

        (new self)->validate($input);

        if (request()->has('enable_maintenance_mode') && ! request()->boolean('enable_maintenance_mode')) {
            $input['maintenance_mode_message'] = null;
        }

        if (request()->has('currencies')) {
            $input['currencies'] = implode(',', Arr::get($input, 'currencies', []));
        }

        return $input;
    }

    private function validate(array $input = []): void
    {
        $timezone = Arr::get($input, 'timezone');
        if ($timezone && ! ListHelper::getListByKey('timezones', 'value', $timezone)) {
            throw ValidationException::withMessages(['timezone' => trans('validation.exists', ['attribute' => trans('config.system.props.timezone')])]);
        }

        $date_format = Arr::get($input, 'date_format');
        if ($date_format && ! ListHelper::getListById('date_formats', $date_format)) {
            throw ValidationException::withMessages(['date_format' => trans('validation.exists', ['attribute' => trans('config.system.props.date_format')])]);
        }

        $time_format = Arr::get($input, 'time_format');
        if ($time_format && ! ListHelper::getListById('time_formats', $time_format)) {
            throw ValidationException::withMessages(['time_format' => trans('validation.exists', ['attribute' => trans('config.system.props.time_format')])]);
        }

        $locale = Arr::get($input, 'locale');

        if ($locale && ! in_array($locale, Arr::pluck($this->getKey('locales'), 'code'))) {
            throw ValidationException::withMessages(['locale' => trans('validation.exists', ['attribute' => trans('config.locale.locale')])]);
        }

        $currencies = Arr::get($input, 'currencies', []);
        foreach ($currencies as $currency) {
            if ($currency && ! ListHelper::getListByKey('currencies', 'name', $currency)) {
                throw ValidationException::withMessages(['currencies' => trans('validation.exists', ['attribute' => trans('config.system.props.currency')])]);
            }
        }

        $currency = Arr::get($input, 'currency');
        if ($currency && ! ListHelper::getListByKey('currencies', 'name', $currency)) {
            throw ValidationException::withMessages(['currency' => trans('validation.exists', ['attribute' => trans('config.system.props.currency')])]);
        }

        if ($currency && ! in_array($currency, $currencies)) {
            throw ValidationException::withMessages(['currency' => trans('config.system.currency_not_allowed')]);
        }
    }
}
