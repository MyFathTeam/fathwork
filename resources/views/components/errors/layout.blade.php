<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Application by Fathforce">
        <meta name="author" content="Fathforce">
        <title>{{config('config.general.app_name', config('app.name', 'Fathforce'))}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" href="{{ config('config.assets.favicon') }}" type="image/png">

        {{-- <link rel="stylesheet" href="https://rsms.me/inter/inter.css"> --}}
        @vite(['resources/js/site.js'])
    </head>
    <body class="{{config('config.layout.display')}}">
        <div class="min-h-screen flex items-center bg-gray-800 overflow-hidden">
            <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 py-4">
                <div class="bg-gray-200 rounded-lg px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
                    <div class="max-w-max mx-auto">
                        <main class="sm:flex">
                            {{$slot}}
                        </main>

                        <div class="mt-6 flex justify-center">
                            <a class="bg-gray-800 px-4 py-2 rounded text-gray-200" href="/">{{trans('global.go_to', ['attribute' => trans('dashboard.home')])}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
