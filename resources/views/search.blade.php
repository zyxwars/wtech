<x-layout>
    <x-header></x-header>

    <x-product-grid :$products>
        <x-breadcrumbs :$breadcrumbs></x-breadcrumbs>

        <h1 class="mb-2 text-3xl font-bold">
            Search results for: “{{ $search }}”
        </h1>
    </x-product-grid>
</x-layout>