<div x-data="{open: true}">
    @if (session()->has('message'))
    <div class="py-2" x-show="open">
        <div class="flex justify-between items-center bg-green-600 text-green-50 px-4 py-2 rounded">
            <div class="pr-10">{{ session('message') }}</div>
            <i class="fas fa-times cursor-pointer" @click="open = false"></i>
        </div>
    </div>
    @endif
</div>