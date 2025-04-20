<x-layout>
    <x-header></x-header>

    <!-- Page layout -->
    <main class="flex min-h-screen justify-center">
        <div class="flex w-full max-w-[1600px] flex-col items-center px-4 lg:px-20">
            <!-- Banner -->
            <a href="{{ $banner['content_url'] }}" class="my-6 w-full flex-none">
                <div class="flex flex-col relative w-full items-center">
                    <h2
                        class="max-w-2/3 xl:max-w-1/2 absolute left-2 top-2 text-4xl font-bold text-white sm:left-6 sm:top-6 sm:text-6xl lg:text-8xl">
                        {{ $banner['text'] }}
                    </h2>
                    <button class="btn btn-primary absolute bottom-2 left-2 sm:bottom-6 sm:left-6"
                        href="{{ $banner['content_url'] }}">
                        More
                    </button>

                    <img class="h-52 w-full object-cover object-center shadow-sm sm:h-64 lg:h-80"
                        src="{{ $banner['image_url'] }}" />
                </div>
            </a>

            <!-- Categories -->
            <nav class="category-grid mb-10">
                @foreach ($categories as $category)
                    <a href="{{ route('product.category', $category->name) }}"
                        class="bg-base-200 flex cursor-pointer items-center rounded-full shadow-sm transition-all duration-150 hover:scale-105">
                        <img class="h-12 w-12 flex-none rounded-full object-cover object-center shadow-sm md:h-16 md:w-16"
                            src="{{ $category->image_uri }}" />
                        <div class="flex w-full justify-center pr-6 md:pr-8">
                            <h3 class="text-md font-medium sm:text-lg">{{ $category->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </nav>

            <!-- Featured products -->
            <section class="flex w-full flex-col gap-6">
                @foreach ($featuredRows as $featuredRow)
                    <x-product-carousel :title="$featuredRow['title']" :products="$featuredRow['products']" />
                @endforeach
            </section>
        </div>
    </main>

    <x-footer></x-footer>
</x-layout>
