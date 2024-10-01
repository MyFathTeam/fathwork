<?php

namespace App\Actions\Config;

use App\Helpers\SysHelper;
use App\Support\SocialLoginProvider;
use Closure;
use Illuminate\Support\Arr;

class GetGeneralConfig
{
    use SocialLoginProvider;

    public function handle($config, Closure $next)
    {
        $config['auth']['social_login_providers'] = $this->getActiveProviders();
        $config['system']['url'] = config('app.url');
        $config['system']['version'] = SysHelper::getApp('VERSION');
        $config['system']['post_max_size'] = SysHelper::getPostMaxSize();
        $config['system']['mode'] = (config('app.mode') == 'test') ? 0 : 1;
        $config['system']['paginations'] = Arr::getList('per_page_lengths');

        $config['system']['currency'] = collect(Arr::getVar('currencies'))->firstWhere('name', Arr::get($config, 'system.currency'));
        $config['system']['currencies'] = collect(Arr::getVar('currencies'))->whereIn('name', explode(',', Arr::get($config, 'system.currencies')))->values();

        $config['authenticated'] = false;
        $config['layout']['display'] = config('config.system.enable_dark_theme') ? 'dark' : 'light';

        if (\Auth::check()) {
            $config['authenticated'] = true;
            $config['layout']['display'] = \Auth::user()->user_display;
        }

        // \App::setLocale($config['system']['locale'] ?: 'en');

        return $next($config);
    }
}
