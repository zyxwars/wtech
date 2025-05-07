@extends('layouts.admin')

@section('title','Edit Product')

@section('content')
<main class="mt-8 flex items-start justify-center p-4">
    <form class="max-w-xl px-4 lg:px-20">
        <!--
        @csrf
        @method('PUT')
        -->
        <h2 class="mb-4 text-2xl font-bold">Update Product</h2>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Album name</legend>
            <input
                type="text"
                class="input w-full"
                placeholder="{{ $product->title }}"
            />
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Author</legend>
            <input
                type="text"
                class="input w-full"
                placeholder="{{ $product->author->name }}"
            />
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Description</legend>
            <textarea
                class="textarea w-full"
                placeholder="{{ $product->description }}"
            ></textarea>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Genre</legend>
            <select class="select w-full">
                <option disabled selected>{{ $product->category->name  }}</option>
                @foreach($categories as $category)
                    <option>{{ $category->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="fieldset mb-4">
            <legend class="fieldset-legend">Release Year</legend>
            <input
                type="number"
                class="input w-full"
                min="0"
                placeholder="{{ $product->release_year }}"
            />
        </fieldset>

        <fieldset class="fieldset mb-4">
            <legend class="fieldset-legend">Price</legend>
            <input
                type="number"
                class="input w-full"
                min="0"
                placeholder="{{ $product->price }}"
            />
        </fieldset>

        <!-- product images -->

        <!-- main product image -->
        <div class="relative w-full">
            <img
                class="h-full w-full cursor-pointer object-cover shadow-sm"
                src="{{ $product->primaryImage ? $product->primaryImage->uri : '/placeholder.png' }}"
                alt="Main image"
            />
            <button
                class="absolute right-2 top-2 flex h-7 w-7 items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-800"
                aria-label="Remove main image"
            >
                X
            </button>
        </div>

        <!-- Secondary images in a flex container -->
        <div class="mb-4 mt-4 flex gap-4">
            @foreach ($product->secondaryImages as $secondaryImage)
                <div class="w-30 h-30 relative">
                    <img
                        class="w-full cursor-pointer object-cover shadow-sm"
                        src="{{ $secondaryImage->uri }}"
                        alt="Secondary image 1"
                    />
                    <button
                        class="absolute right-2 top-2 flex h-7 w-7 items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-800"
                        aria-label="Remove secondary image 1"
                    >
                        X
                    </button>
                </div>
            @endforeach
        </div>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Pick an image file</legend>
            <input type="file" class="file-input w-full" />
        </fieldset>

        <div class="mb-4 mt-16">
            <button class="btn btn-success" type="submit">Save</button>
            <button class="btn btn-error ml-4" type="submit">
                Cancel
            </button>
        </div>
    </form>
</main>
@endsection
