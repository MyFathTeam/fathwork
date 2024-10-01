<x-site.layout>
    <img class="h-48 w-full object-cover lg:h-72" src="/images/site-background.jpg" />

    <div class="w-full flex items-center justify-center -mt-16">
        <div class="flex items-center justify-center h-32 w-32 rounded-full text-5xl bg-primary text-white">{{ Str::substr(config('app.name'), 0, 1) }}</div>
    </div>

    <h1 class="mt-6 text-4xl text-center">
        {{ config('app.name') }}
    </h1>
</x-site.layout>