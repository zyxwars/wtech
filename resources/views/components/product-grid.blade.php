<!-- https://daisyui.com/components/drawer/ -->
<div class="drawer">
    <input id="filter-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content w-full">

        <!-- Page layout -->
        <main class="flex min-h-screen justify-center">
            <div class="w-full max-w-[1600px] px-4 lg:px-20">
                {{ $slot }}

                <!-- Controls -->
                <!-- https://daisyui.com/components/select/ -->
                <section class="mb-4 flex w-full justify-end gap-2">
                    <select class="select select-primary max-w-42">
                        <option>Recommended</option>
                        <option>Price Lowest</option>
                        <option>Price Highest</option>
                    </select>

                    <label for="filter-drawer" class="drawer-button btn btn-primary">Filter</label>
                </section>

                <!-- Products -->
                <article class="products-grid mb-8">
                    @foreach ($products as $product)
                    <x-product-tile :$product></x-product-tile>
                    @endforeach
                </article>

                <!-- Pagination -->
                {{$products->links()}}
            </div>
        </main>

        <x-footer></x-footer>
    </div>

    <div class="drawer-side z-20">
        <label
            for="filter-drawer"
            aria-label="close sidebar"
            class="drawer-overlay"></label>

        <div
            class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Filter -->
            <form>
                <h2 class="text-lg font-bold">Price</h2>
                <div class="flex gap-2">
                    <input type="number" placeholder="Start" class="input" />
                    <input type="number" placeholder="End" class="input" />
                </div>

                <h2 class="mt-4 text-lg font-bold">Author</h2>
                <select class="select">
                    <option>Crimson</option>
                    <option>Amber</option>
                    <option>Velvet</option>
                </select>

                <h2 class="mt-4 text-lg font-bold">Language</h2>
                <select class="select">
                    <option>Slovak</option>
                    <option>English</option>
                    <option>Hungarian</option>
                </select>

                <h2 class="mt-4 text-lg font-bold">Release year</h2>
                <div class="flex gap-2">
                    <input type="number" placeholder="Start" class="input" />
                    <input type="number" placeholder="End" class="input" />
                </div>

                <button class="btn btn-primary mt-4" type="submit">Filter</button>
            </form>
        </div>
    </div>
</div>