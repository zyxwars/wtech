<x-layout>
    <x-header></x-header>



    <!-- Page layout -->
    <main class="flex min-h-screen justify-center">
        <div class="w-full max-w-[1600px] px-4 lg:px-20">
            <x-breadcrumbs :$breadcrumbs></x-breadcrumbs>

            <article class="mb-8 flex w-full flex-col gap-6 sm:flex-row">
                <!-- product images -->
                <div>
                    <!-- main product image -->
                    <img class="rs-gallery aspect-square w-full cursor-pointer object-cover object-center shadow-sm sm:w-[40rem]"
                        src="/placeholder.png" />

                    <div class="flex flex-wrap gap-4">
                        <!-- secondary image -->
                        <img class="aspect-square w-24 rs-gallery mt-4 flex-none cursor-pointer object-cover shadow-sm"
                            src="/placeholder.png" />

                        <img class="aspect-square w-24 rs-gallery mt-4 flex-none cursor-pointer object-cover shadow-sm"
                            src="/placeholder.png" />
                    </div>
                </div>

                <!-- Product detail -->
                <section class="flex flex-col items-start">
                    <h1 class="mb-2 text-4xl font-bold sm:text-4xl">
                        {{ $product->title }}
                    </h1>

                    <p class="text-md mb-4">
                        {{ $product->description }}
                    </p>

                    <ul class="mb-8 sm:text-lg">
                        <li>
                            <span class="font-bold">Author: </span>
                            {{ $product->author->name }}
                        </li>
                        <li>
                            <span class="font-bold">Category: </span>
                            {{ $product->category->name }}
                        </li>
                        <li>
                            <span class="font-bold">Release year: </span>
                            {{ $product->release_year }}
                        </li>
                        <li>
                            <span class="font-bold">Language: </span>
                            {{ $product->language->name }}
                        </li>
                    </ul>

                    <!-- product price button-->
                    <form class="flex items-center gap-4" action="{{ route('cart.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="productId" value="{{ $product->id }}">

                        <button class="buy-button cursor-pointer transition-all duration-150 hover:scale-105"
                            type="submit">
                            {{ number_format($product->price / 100, 2) }} €
                        </button>

                        <input name="quantity" type="number" value="1" min="1"
                            class="input max-w-24 sm:h-full" />
                    </form>
                </section>
            </article>


            <x-product-carousel :title="$featuredRow['title']" :products="$featuredRow['products']" />
        </div>
    </main>


    <x-footer></x-footer>
</x-layout>
