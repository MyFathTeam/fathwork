<?php

namespace App\Services;

use App\Models\Faththink;
use Illuminate\Http\Request;

class FaththinkService
{
    public function create(Request $request): Faththink
    {
        $faththink = Faththink::forceCreate($this->formatParams($request));

        return $faththink;
    }

    private function formatParams(Request $request, ?Faththink $faththink = null): array
    {
        return [
            'humidity' => $request->humidity,
            'temperature' => $request->temperature,
            'soil_moisture' => $request->soil_moisture,
        ];
    }

    public function update(Request $request, Faththink $faththink): void
    {
        $faththink->forceFill($this->formatParams($request, $faththink))->save();
    }

    public function deletable(Faththink $faththink): void
    {
    }
}
