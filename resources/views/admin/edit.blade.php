@extends('layouts.admin')

@section('title','Edit Product')

@section('content')
<main class="mt-8 flex items-start justify-center p-4">
    <div class="max-w-xl px-4 lg:px-20">
        <form id="update_form" method="POST" action="{{ route('admin.update', $product->id) }}" >
            @csrf
            @method('PUT')

            <h2 class="mb-4 text-2xl font-bold">Update Product</h2>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Album name</legend>
                <input
                    type="text"
                    name="title"
                    class="input w-full"
                    value="{{ old('title', $product->title) }}"
                />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Author</legend>
                <input
                    type="text"
                    name="author_id"
                    class="input w-full"
                    value="{{ old('author', $product->author->name) }}"
                />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Description</legend>
                <textarea
                    class="textarea w-full"
                    name="description"
                    >{{ old('description', $product->description) }}
                </textarea>
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Genre</legend>
                <select class="select w-full" name="category_id">
                    <option disabled selected>{{ $product->category->name  }}</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend">Release Year</legend>
                <input
                    type="number"
                    class="input w-full"
                    name="release_year"
                    min="0"
                    value="{{ old('release_year', $product->release_year) }}"
                />
            </fieldset>

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend">Price</legend>
                <input
                    type="number"
                    class="input w-full"
                    name="price"
                    min="0"
                    value="{{ old('price', $product->price) }}"
                />
            </fieldset>

            <div class="mb-4 mt-16">
                <button class="btn btn-success" type="submit" form="update_form">Save changes</button>
                <button class="btn btn-error ml-4" type="submit">
                    Discard changes
                </button>
            </div>
        </form> 

            <!-- product images -->
            <!-- main product image -->
        <div>
            <div class="relative w-full">
                @if ($product->primaryImage)
                    <img
                        class="h-full w-full cursor-pointer object-cover shadow-sm"
                        src="{{ $product->primaryImage->uri }}"
                        alt="Main image"
                    />
                    
                    <form method="POST" action="{{ route('admin.images.destroy', $product->primaryImage->id) }}">
                        @method('DELETE')
                        @csrf 
                        
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <button
                            type="submit"
                            class="absolute right-2 top-2 flex h-7 w-7 items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-800"
                            aria-label="Remove main image"
                        >
                            X
                        </button>
                    </form>
                @endif
                
            </div>
        
            <!-- Secondary images in a flex container -->
            <div class="mb-4 mt-4 flex gap-4">
                @foreach ($product->secondaryImages as $secondaryImage)
                    <div class="w-30 h-30 relative">
                        <img
                            class="w-full cursor-pointer object-cover shadow-sm"
                            src="{{ $secondaryImage->uri }}"
                            alt="Secondary image"
                        />
                        <form method="POST" action="{{ route('admin.images.destroy', $secondaryImage->id) }}">
                            @csrf 
                            @method('DELETE')
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <button
                                type="submit"
                                class="absolute right-2 top-2 flex h-7 w-7 items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-800"
                                aria-label="Remove secondary image 1"
                            >
                                X
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            

            
        
            <form id="upload_images_form" method="POST" action="{{ route('admin.images.upload', $product->id) }}" enctype="multipart/form-data">
                @csrf
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Pick an image file</legend>
                    <input type="file" class="file-input w-full" name="images[]" multiple/>
                </fieldset>
                <div class="mt-4">
                    <button class="btn btn-primary" type="submit">Upload Images</button>
                </div>
            </form>

            
        </div>
    </div>
    

</main>
@endsection
