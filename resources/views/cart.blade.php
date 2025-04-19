<x-layout>
    <x-header></x-header>

    <!-- Page layout -->
    <main class="mb-12 flex min-h-screen justify-center">
        <div class="w-full max-w-4xl px-4">
            <x-breadcrumbs :$breadcrumbs></x-breadcrumbs>

            <section class="flex w-full flex-col items-center gap-4">
                <!-- https://daisyui.com/components/steps/ -->
                <ul class="steps mb-8 w-full">
                    <li class="step step-primary">Details</li>
                    <li class="step">Delivery and Payment</li>
                    <li class="step">Order Submitted</li>
                </ul>

                <!-- Product list -->
                @foreach ($products as $product)
                    <article class="mb-2 flex w-full flex-wrap items-start gap-2 sm:flex-nowrap">
                        <div class="flex w-full gap-4">
                            <img class="h-[4rem] w-[4rem] flex-none object-cover object-center" src="/placeholder.png" />

                            <div class="sm:mr-8">
                                <a href="{{ route('product.show', $product->id) }}" class="text-xl font-semibold">
                                    <h3>{{ $product->title }}</h3>
                                </a>
                                <h4 class="text-md mb-2"> {{ $product->author->name }}</h4>
                            </div>
                        </div>

                        <div class="flex w-full items-start justify-between">
                            <input type="number" value="1" class="input max-w-14" />

                            <p class="text-lg font-bold">{{ number_format($product->price / 100, 2) }} €</p>

                            <button class="cursor-pointer">
                                <span class="material-symbols-outlined !text-[14px]"> close </span>
                            </button>
                        </div>
                    </article>
                @endforeach

                <section class="flex w-full items-center justify-end gap-8">
                    <h3 class="flex gap-2 text-xl">
                        <span class="font-bold">Total:</span>
                        {{ $total }}
                    </h3>

                    <a href="{{ route('order.create') }}" class='btn btn-primary'>
                        Checkout
                    </a>
                </section>
            </section>
        </div>
    </main>

    <x-footer></x-footer>
</x-layout>
