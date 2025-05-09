@extends('layouts.admin')

@section('title','Admin Dashboard')

@section('content')
  <div class="mb-4 mt-16 flex items-center justify-between">
    <a href="/"><!-- route('admin.products.create')  -->
      <button class="btn btn-primary">+ Add product</button>
    </a>

    <label class="input">
      <!-- search icon inline SVG -->
      <input type="search" class="grow" placeholder="Search" />
    </label>
  </div>

  <div class="overflow-x-auto">
    <table class="mb-10 table">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Category</th>
          <th>Author</th>
          <th>Release Year</th>
          <th>Price</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td class="flex items-center gap-3">
              <img src="{{ $product->primaryImage ? $product->primaryImage->uri : '/placeholder.png' }}"
                   class="mask mask-squircle h-12 w-12" alt="">
              <span class="font-bold">{{ $product->title }}</span>
            </td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->author->name }}</td>
            <td>{{ $product->release_year }}</td>
            <td>{{ number_format($product->price / 100,2) }}€</td>
            <td>
              <a href="{{ route('admin.edit',$product->id)  }}">
                <span class="material-symbols-outlined">edit_square</span>
              </a>
            </td>
            <td>
              <form action="{{ route('admin.destroy',$product) }}" method="POST">
                @csrf 
                @method('DELETE')
                <button class="btn btn-ghost btn-xs">
                  <span class="material-symbols-outlined" type="submit">delete</span>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{ $products->links() }} {{-- Blade pagination links --}}
@endsection
