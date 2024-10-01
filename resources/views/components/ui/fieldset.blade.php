@props(['title' => ''])

<fieldset {{ $attributes->merge(['class' => 'border rounded-md border-solid border-gray-300 dark:border-gray-700 p-3']) }}>
    <legend class="text-sm p-2 border border-gray-300 font-semibold dark:border-gray-700 text-gray-800 dark:text-gray-300 rounded">
        {{ $title }}
    </legend>
    {{ $slot }}
</fieldset>