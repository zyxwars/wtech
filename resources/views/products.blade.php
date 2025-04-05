<x-layout>
    @foreach ($products as $product)
    <p>{{ $product->title}}</p>
    @endforeach
</x-layout>