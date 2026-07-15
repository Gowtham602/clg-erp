<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-900 via-indigo-800 to-blue-700 px-4">

        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden">

            <div class="grid md:grid-cols-2">

                <!-- Left Side -->
                <div class="hidden md:flex flex-col justify-center items-center bg-blue-800 text-white p-12">

                    <!-- <img src="{{ asset('images/clg-logo.png') }}"
                         class="w-28 h-28 mb-6"
                         alt="College Logo"> -->

                    <h1 class="text-4xl font-bold mb-3">
                        College ERP
                    </h1>

                    <p class="text-blue-100 text-center leading-7">
                        Student Management System<br>
                        Attendance • Fees • Exams • Results
                    </p>

                </div>
                

                <!-- Right Side -->
                <div class="p-8 md:p-12">

                    <div class="text-center mb-8">

                        <h2 class="text-3xl font-bold text-gray-800">
                            Welcome Back
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Login to your account
                        </p>

                    </div>

                    <x-auth-session-status
                        class="mb-4"
                        :status="session('status')"
                    />

                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <!-- Email -->

                        <div class="mb-5">

                            <x-input-label
                                for="email"
                                :value="__('Email Address')"
                            />

                            <x-text-input
                                id="email"
                                class="block mt-2 w-full rounded-xl"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-2"
                            />

                        </div>

                        <!-- Password -->

                        <div class="mb-5">

                            <x-input-label
                                for="password"
                                :value="__('Password')"
                            />

                            <x-text-input
                                id="password"
                                class="block mt-2 w-full rounded-xl"
                                type="password"
                                name="password"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />

                        </div>

                        <!-- Remember -->

                        <div class="flex items-center justify-between mb-6">

                            <label class="flex items-center">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="rounded text-blue-600">

                                <span class="ml-2 text-sm text-gray-600">
                                    Remember Me
                                </span>

                            </label>

                            @if(Route::has('password.request'))

                                <a href="{{ route('password.request') }}"
                                   class="text-sm text-blue-600 hover:underline">

                                    Forgot Password?

                                </a>

                            @endif

                        </div>

                        <button
                            type="submit"
                            class="w-full bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-xl font-semibold transition">

                            Login

                        </button>

                    </form>

                    <div class="mt-8 text-center text-sm text-gray-500">

                        © {{ date('Y') }} College ERP System

                    </div>

                </div>

            </div>

        </div>

    </div>
</x-guest-layout>