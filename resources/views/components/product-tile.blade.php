<article class="w-full">
    <a href="">
        <img
            class="aspect-square w-full object-cover object-center"
            src="/placeholder.png" />
    </a>

    <div class="p-2">
        <a href="./detail.html" class="text-xl font-bold">
            <h3> {{ $product->title }}</h3>
        </a>
        <h4 class="text-md mb-2"> {{ $product->author->name}}</h4>

        <div class="flex w-full items-center justify-between">
            <p class="font-bold"> {{ $product->price / 100 }}€</p>

            <button class="btn btn-primary">
                <span class="material-symbols-outlined text-white">
                    shopping_cart
                </span>
            </button>
        </div>
    </div>
</article>