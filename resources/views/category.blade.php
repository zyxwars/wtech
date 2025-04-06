<x-layout>
    <x-header></x-header>

    <x-product-grid :$products>
        <x-breadcrumbs :$breadcrumbs></x-breadcrumbs>

        <section class="mb-2">
            <h1 class="mb-2 text-4xl font-bold">{{ $category->name }}</h1>
            <p>
                {{ $category->description }}
            </p>
        </section>
    </x-product-grid>
</x-layout>