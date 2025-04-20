<x-layout>
    <x-header></x-header>

    <!-- Page layout -->
    <main class="mb-12 flex min-h-screen justify-center">
        <div class="w-full max-w-4xl px-4">
            <!-- https://daisyui.com/components/breadcrumbs/ -->
            <nav class="breadcrumbs pb-3 pt-4 text-sm sm:pt-4">
                <ul>
                    <li><a href="./index.html">Home</a></li>
                    <li>Order Submitted</li>
                </ul>
            </nav>

            <div class="flex w-full flex-col items-center gap-4">
                <h1 class="mb-4 text-3xl font-bold sm:mb-8">
                    Order {{ $order->id }} Submitted
                </h1>

                <!-- Product list -->
                @foreach ($order->orderItems as $orderItem)
                    <article class="mb-2 flex w-full flex-wrap items-start gap-2 sm:flex-nowrap">
                        <div class="flex w-full gap-4">
                            <img class="h-[4rem] w-[4rem] flex-none object-cover object-center"
                                src="{{ $orderItem->product->primaryImage ? $orderItem->product->primaryImage->uri : '/placeholder.png' }}" />

                            <div class="sm:mr-8">
                                <a href="{{ route('product.show', $orderItem->product->id) }}"
                                    class="text-xl font-semibold">
                                    <h3>{{ $orderItem->product->title }}</h3>
                                </a>
                                <h4 class="text-md mb-2"> {{ $orderItem->product->author->name }}</h4>
                            </div>
                        </div>

                        <div class="flex w-full items-start justify-between">
                            <p class="text-lg">{{ $orderItem->quantity }} </p>

                            <p class="text-lg font-bold">{{ number_format($orderItem->price / 100, 2) }} €</p>
                    </article>
                @endforeach


                <h3 class="flex w-full justify-between text-lg">
                    <span class="font-bold">Delivery method:</span>
                    {{ $order->deliveryMethod->name }}
                </h3>

                <h3 class="flex w-full justify-between text-lg">
                    <span class="font-bold">Payment method:</span>
                    {{ $order->paymentMethod->name }}
                </h3>

                <h3 class="flex w-full justify-between text-lg">
                    <span class="font-bold">Total:</span>
                    {{ number_format($order->total / 100, 2) }} €
                </h3>
            </div>
        </div>
    </main>

    <x-footer></x-footer>
</x-layout>
