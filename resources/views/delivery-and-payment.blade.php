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

                <form class="grid max-w-[20rem] grid-flow-row gap-2" method="POST" action="{{ route('order.create') }}">
                    @csrf

                    <h1 class="mb-2 text-2xl font-bold">
                        Address and Contact
                    </h1>

                    <div class="flex gap-2">
                        <input type="text" name="first_name" placeholder="First Name" class="input"
                            value="{{ old('first_name') }}" />
                        <input type="text" name="last_name" placeholder="Last Name" class="input"
                            value="{{ old('last_name') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('first_name')" />
                    <x-input-error :messages="$errors->get('last_name')" />

                    <input type="text" name="email" placeholder="Email" type="email" class="input"
                        value="{{ old('email') }}" />
                    <x-input-error :messages="$errors->get('email')" />

                    <input type="text" name="phone_number" placeholder="Phone Number" class="input"
                        value="{{ old('phone_number') }}" />
                    <x-input-error :messages="$errors->get('phone_number')" />

                    <input type="text" name="country" placeholder="Country" class="input"
                        value="{{ old('country') }}" />
                    <x-input-error :messages="$errors->get('country')" />

                    <input type="text" name="city" placeholder="City" class="input"
                        value="{{ old('city') }}" />
                    <x-input-error :messages="$errors->get('city')" />

                    <div class="flex gap-2">
                        <input type="text" name="street" placeholder="Street" class="input"
                            value="{{ old('street') }}" />
                        <input type="text" name="postal_code" placeholder="Postal Code" class="input"
                            value="{{ old('postal_code') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('street')" />
                    <x-input-error :messages="$errors->get('postal_code')" />

                    <h2 class="text-lg font-bold">Delivery</h2>
                    <select name="delivery_method" class="select w-full">
                        <option disabled {{ old('delivery_method') ? '' : 'selected' }}>Delivery method</option>
                        @foreach ($deliveryMethods as $deliveryMethod)
                            <option value="{{ $deliveryMethod->name }}"
                                {{ old('delivery_method') == $deliveryMethod->name ? 'selected' : '' }}>
                                {{ $deliveryMethod->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('delivery_method')" />

                    <h2 class="text-lg font-bold">Pay</h2>
                    <select name="payment_method" class="select w-full">
                        <option disabled {{ old('payment_method') ? '' : 'selected' }}>Payment method</option>
                        @foreach ($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->name }}"
                                {{ old('payment_method') == $paymentMethod->name ? 'selected' : '' }}>
                                {{ $paymentMethod->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('payment_method')" />

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
