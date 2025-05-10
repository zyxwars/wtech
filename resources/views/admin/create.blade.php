@extends('layouts.admin')

@section('title','Create Product')

@section('content')
<main class="mt-8 flex items-start justify-center p-4">
    <div class="max-w-xl px-4 lg:px-20">
        <form id="create_form" method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" >
            @csrf

            <h2 class="mb-4 text-2xl font-bold">Create Product</h2>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Album name</legend>
                <input
                    type="text"
                    name="title"
                    class="input w-full"
                    placeholder="Enter album name"
                    required
                />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Author</legend>
                <input
                    type="text"
                    name="author_id"
                    class="input w-full"
                    placeholder="Enter author name"
                    required
                />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Description</legend>
                <textarea
                    class="textarea w-full"
                    name="description"
                    placeholder="Enter album description"
                    required
                ></textarea>
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Genre</legend>
                <select class="select w-full" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Language</legend>
                <select class="select w-full" name="language_id">
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}">
                            {{ $language->name }}
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
                    placeholder="Enter release year"
                    required
                />
            </fieldset>

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend">Price</legend>
                <input
                    type="number"
                    class="input w-full"
                    name="price"
                    min="0"
                    placeholder="Enter price"
                    required
                />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Pick an image file</legend>
                <input type="file" class="file-input w-full" name="images[]" multiple/>
            </fieldset>

            <div class="mb-4 mt-16">
                <button class="btn btn-success" type="submit" form="create_form">Save changes</button>
                <a href="/admin" class="btn btn-error ml-4">Discard changes</a>
            </div>
        </form> 

        
        
    </div>
    

</main>
@endsection
