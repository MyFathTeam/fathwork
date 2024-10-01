<?php

namespace App\Enums;

use App\Concerns\HasEnum;
use Illuminate\Support\Arr;

enum OptionType: string
{
    use HasEnum;

    case TODO_LIST = 'todo_list';

    public function detail(): array
    {
        return match ($this) {
            self::TODO_LIST => [
                'type' => 'todo_list',
                'module' => 'utility',
                'sub_module' => 'todo_list',
                'permission' => 'utility:config',
                'team' => false,
            ],
            default => []
        };
    }

    public static function getOptions(): array
    {
        $options = [];

        foreach (self::cases() as $option) {
            $detail = $option->detail();

            $module = Arr::get($detail, 'module');
            $subModule = Arr::get($detail, 'sub_module');

            $options[] = ['label' => trans($module.'.'.$subModule.'.'.$subModule), 'value' => $option->value];
        }

        return $options;
    }
}
