<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncLocale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:locale {code? : Code of Locale} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync locale';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $force = $this->option('force');

        if (\App::environment('production') && ! $force) {
            $this->error('Could not sync in production mode');
            exit;
        }

        $code = $this->argument('code') ?? $this->ask('Enter locale code');

        if ($code == 'en') {
            $this->error('Could not sync default locale');
            exit;
        }

        if (! \File::exists(base_path('lang/'.$code))) {
            $this->error('Locale doesn\'t exists');
            exit;
        }

        $baseLocale = 'en';

        $modules = [];
        foreach (\File::allFiles(base_path('/lang/en')) as $file) {
            $modules[] = basename($file, '.php');
        }

        foreach ($modules as $module) {
            $file = base_path('/lang/'.$baseLocale.'/'.$module.'.php');
            $baseWords = \File::getRequire($file);

            $file = base_path('/lang/'.$code.'/'.$module.'.php');
            $words = \File::getRequire($file);

            $newWords = array_merge_recursive_distinct($baseWords, $words);

            $file = base_path('/lang/'.$code.'/'.$module.'.php');
            \File::put($file, var_export($newWords, true));
            \File::prepend($file, '<?php return ');
            \File::append($file, ';');
        }

        $this->info('Locale synced.');
    }
}
