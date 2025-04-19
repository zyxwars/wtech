{{-- TODO: is wrapping the whole component in a form okay?  --}}
<!-- https://daisyui.com/components/drawer/ -->
<div class="drawer">
    <input id="filter-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content w-full">

        {{-- Page layout --}}
        <main class="flex min-h-screen justify-center">
            <div class="w-full max-w-[1600px] px-4 lg:px-20">
                {{ $slot }}

                {{-- Controls --}}
                <!-- https://daisyui.com/components/select/ -->
                <form action method="GET" class="mb-4 flex w-full justify-end gap-2">
                    <select class="select select-primary max-w-42" onchange="this.form.submit()" name="order">
                        <option value="default">Recommended</option>
                        <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>Price
                            Lowest</option>
                        <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>Price
                            Highest</option>
                    </select>

                    <label for="filter-drawer" class="drawer-button btn btn-primary">Filter</label>
                </form>

                {{-- Products --}}
                <article class="product-grid mb-8">
                    @foreach ($products as $product)
                        <article class="w-full">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img class="aspect-square w-full object-cover object-center" src="/placeholder.png" />
                            </a>

                            <div class="p-2">
                                <a href="{{ route('product.show', $product->id) }}" class="text-xl font-bold">
                                    <h3> {{ $product->title }}</h3>
                                </a>
                                <h4 class="text-md mb-2"> {{ $product->author->name }}</h4>

                                <div class="flex w-full items-center justify-between">
                                    <p class="font-bold">{{ number_format($product->price / 100, 2) }} €</p>

                                    <form method="POST" action="{{ route('cart.store') }}">
                                        @csrf
                                        <input name="productId" type="hidden" value="{{ $product->id }}">

                                        <button class="btn btn-primary" type="submit">
                                            <span class="material-symbols-outlined text-white">
                                                shopping_cart
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </article>

                {{-- Pagination --}}
                {{ $products->links() }}
            </div>
        </main>

        <x-footer></x-footer>
    </div>

    {{-- Filter --}}
    <form action method="GET" class="drawer-side z-20">
        <label for="filter-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

        <div class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <h2 class="text-lg font-bold">Price</h2>
            <div class="flex gap-2">
                <input name="price_start" value="{{ request('price_start') }}" type="number" placeholder="Start"
                    class="input" min="0" />
                <input name="price_end" value="{{ request('price_end') }}" type="number" placeholder="End"
                    class="input" />
            </div>

            <h2 class="mt-4 text-lg font-bold">Author</h2>
            <select name="author" class="select">
                <option value="">All</option>
                @foreach ($authors as $author)
                    <option value="{{ $author }}" {{ request('author') == "$author" ? 'selected' : '' }}>
                        {{ $author->name }}</option>
                @endforeach
            </select>

            <h2 class="mt-4 text-lg font-bold">Language</h2>
            <select name="language" class="select">
                <option value="">All</option>
                @foreach ($languages as $language)
                    <option value="{{ $language }}" {{ request('language') == "$language" ? 'selected' : '' }}>
                        {{ $language->name }}</option>
                @endforeach
            </select>

            <h2 class="mt-4 text-lg font-bold">Release year</h2>
            <div class="flex gap-2">
                <input name="release_year_start" value="{{ request('release_year_start') }}" type="number"
                    placeholder="Start" class="input" min="0" />
                <input name="release_year_end" value="{{ request('release_year_end') }}" type="number"
                    placeholder="End" class="input" />
            </div>

            <button class="btn btn-primary mt-4" type="submit">Filter</button>
    </form>
</div>
</div>
