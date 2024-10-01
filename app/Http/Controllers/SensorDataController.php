<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'humidity' => 'required',
            'temperature' => 'required',
            'soil_moisture' => 'required',
        ]);

        try {
            // Simpan data ke database
            $sensorData = new SensorData();
            $sensorData->humidity = $request->humidity;
            $sensorData->temperature = $request->temperature;
            $sensorData->soil_moisture = $request->soil_moisture;
            $sensorData->save();

            return response()->json(['message' => 'Data berhasil disimpan ke database'], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan dan log pesan kesalahan
            \Log::error('Gagal menyimpan data ke database: ' . $e->getMessage());

            return response()->json(['error' => 'Gagal menyimpan data ke database'], 500);
        }
    }
}
