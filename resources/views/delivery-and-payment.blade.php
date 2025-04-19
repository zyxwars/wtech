<x-layout>
    <x-header></x-header>

    <!-- Page layout -->
    <main class="mb-12 mt-6 flex min-h-screen justify-center">
        <div class="w-full max-w-4xl px-4">
            <x-breadcrumbs :$breadcrumbs></x-breadcrumbs>

            <section class="flex w-full flex-col items-center gap-4">
                <!-- https://daisyui.com/components/steps/ -->
                <ul class="steps mb-8 w-full">
                    <li class="step step-primary">Details</li>
                    <li class="step step-primary">Delivery and Payment</li>
                    <li class="step">Order Submitted</li>
                </ul>


                <form class="grid max-w-[20rem] grid-flow-row gap-2">
                    <h1 class="mb-2 text-2xl font-bold">
                        Address and Contact
                    </h1>
                    <div class="flex gap-2">
                        <input type="text" placeholder="First Name" class="input" />
                        <input type="text" placeholder="Last Name" class="input" />
                    </div>

                    <input type="text" placeholder="Email" class="input" />

                    <input type="text" placeholder="Phone Number" class="input" />

                    <input type="text" placeholder="Country" class="input" />

                    <input type="text" placeholder="City" class="input" />

                    <div class="flex gap-2">
                        <input type="text" placeholder="Street" class="input" />
                        <input type="text" placeholder="Postal Code" class="input" />
                    </div>

                    <h2 class="text-lg font-bold">Delivery</h2>
                    <select class="select w-full">
                        <option disabled selected>Delivery method</option>
                        <option>Postal service</option>
                        <option>Courier</option>
                    </select>

                    <h2 class="text-lg font-bold">Pay</h2>
                    <select class="select w-full">
                        <option disabled selected>Payment method</option>
                        <option>Online</option>
                        <option>Upon delivery</option>
                    </select>

                    <div class="flex w-full justify-end">
                        <button type="submit" class="btn btn-primary mt-2">
                            Submit Order
                        </button>
                    </div>

                </form>
            </section>
        </div>
    </main>

    <x-footer></x-footer>
</x-layout>
