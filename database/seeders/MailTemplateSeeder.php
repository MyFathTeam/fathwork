<?php

namespace Database\Seeders;

use App\Models\Config\MailTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = Arr::get(Arr::getVar('templates'), 'mail');

        foreach ($templates as $template) {
            MailTemplate::firstOrCreate([
                'code' => Arr::get($template, 'code'),
            ], Arr::except($template, 'variables'));
        }
    }
}
