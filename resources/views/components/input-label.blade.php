@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
<style>
    .text-gray-700 {
    --tw-text-opacity: 1;
    color: rgb(2 255 0);
    margin: 4px;
}
</style>
