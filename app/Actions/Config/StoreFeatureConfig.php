<?php

namespace App\Actions\Config;

class StoreFeatureConfig
{
    public static function handle(): array
    {
        $input = request()->validate([
            'enable_todo' => 'sometimes|boolean',
            'enable_backup' => 'sometimes|boolean',
            'enable_activity_log' => 'sometimes|boolean',
        ], [], [
            'enable_todo' => __('config.feature.props.todo'),
            'enable_backup' => __('config.feature.props.backup'),
            'enable_activity_log' => __('config.feature.props.activity_log'),
        ]);

        return $input;
    }
}
