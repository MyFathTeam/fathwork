@extends('landing.app')

@section('content')
<section>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">Humidity</th>
                <th scope="col" style="text-align: center">Temperature</th>
                <th scope="col" style="text-align: center">Soil Moisture</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fathinks as $item)
            <tr>
                <td style="font-size: 20px; text-align:center;">({{$item->humidity}}%)</td>
                <td style="font-size: 20px; text-align:center;">({{$item->temperature}}°C)</td>
                <td style="font-size: 20px; text-align:center;">({{$item->soil_moisture}}°)</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
