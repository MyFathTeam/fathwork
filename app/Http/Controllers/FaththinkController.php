<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaththinkRequest;
use App\Http\Resources\FaththinkResource;
use App\Services\FaththinkService;
use App\Services\FaththinkListService;
use App\Models\Faththink;
use Illuminate\Http\Request;

class FaththinkController extends Controller
{
    public function fathink()
    {
        $fathinks = Faththink::all();

        return view('landing.pages2.dataarduino', compact('fathinks'));
    }

    public function index(Request $request, FaththinkListService $service)
    {
        return $service->paginate($request);
    }

    public function store(FaththinkRequest $request, FaththinkService $service)
    {
        $faththink = $service->create($request);

        return response()->success([
            'message' => trans('global.created', ['attribute' => trans('master.faththink.faththink')]),
            'faththink' => FaththinkResource::make($faththink),
        ]);
    }


    public function show(Faththink $faththink): FaththinkResource
    {
        return FaththinkResource::make($faththink);
    }

    public function update(FaththinkRequest $request, Faththink $faththink, FaththinkService $service)
    {
        $service->update($request, $faththink);

        return response()->success([
            'message' => trans('global.updated', ['attribute' => trans('faththink.faththink')]),
        ]);
    }

    public function destroy(Faththink $faththink)
    {
        $faththink->delete();

        return response()->success([
            'message' => trans('global.deleted', ['attribute' => trans('faththink.faththink')]),
        ]);
    }

    public function data(Request $request)
    {
        // Mengambil data dari permintaan
        $data = $request->all();

        // Menyimpan data ke database
        try {
            Faththink::create($data);
            return response()->json(['message' => 'Data berhasil disimpan ke database'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan data ke database'], 500);
        }
    }
}