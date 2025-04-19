<article class="relative w-full">
    {{-- Title --}}
    <h2 class="mb-4 text-4xl font-bold">{{ $title }}</h2>

    <section class="no-scrollbar rs-carousel-scroll flex w-full min-w-0 snap-x snap-mandatory gap-6 overflow-auto">

        {{-- Products --}}
        @foreach ($products as $product)
            <article class="no-scrollbar w-[15rem] flex-none snap-center snap-always sm:w-[18rem]">
                <a href="{{ route('product.show', $product->id) }}">
                    <img class="aspect-square w-full object-cover object-center" src="/placeholder.png" />
                </a>

                <div class="p-2">
                    <a href="{{ route('product.show', $product->id) }}" class="text-xl font-bold">
                        <h3>{{ $product->title }}</h3>
                    </a>
                    <h4 class="text-md mb-2">{{ $product->author->name }}</h4>

                    <div class="flex w-full items-center justify-between">
                        <p class="font-bold">{{ number_format($product->price / 100, 2) }} €</p>

                        <button class="btn btn-primary">
                            <span class="material-symbols-outlined text-white">
                                shopping_cart
                            </span>
                        </button>
                    </div>
                </div>
            </article>
        @endforeach

        {{-- Carousel controls --}}
        <button class="btn btn-base-100 btn-circle rs-carousel-left top-2/5 absolute left-2">
            <span class="material-symbols-outlined">chevron_left</span>
        </button>

        <button class="btn btn-base-100 btn-circle rs-carousel-right top-2/5 absolute right-2">
            <span class="material-symbols-outlined">chevron_right</span>
        </button>
    </section>
</article>
