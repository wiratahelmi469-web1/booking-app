@extends('layouts.user')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- BACK BUTTON -->
    <div class="mb-8">

        <a href="{{ route('services.index') }}"
           class="inline-flex items-center gap-2
                  text-blue-600 hover:text-blue-700
                  font-semibold transition">

            ← Back to Services

        </a>

    </div>

    <!-- MAIN CARD -->
    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            <!-- IMAGE -->
            <div class="relative h-[350px] lg:h-full overflow-hidden">

                @if($service->image)

                    <img src="{{ asset('storage/'.$service->image) }}"
                         alt="{{ $service->name }}"
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">

                @else

                    <div class="w-full h-full bg-gray-200
                                flex items-center justify-center
                                text-gray-400 text-2xl">

                        No Image

                    </div>

                @endif

                <!-- PRICE -->
                <div class="absolute top-6 right-6
                            bg-white px-5 py-3
                            rounded-2xl shadow-lg">

                    <p class="text-sm text-gray-500">

                        Starting From

                    </p>

                    <h2 class="text-2xl font-bold text-blue-600">

                        Rp {{ number_format($service->price) }}

                    </h2>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-8 lg:p-12 flex flex-col justify-between">

                <div>

                    <!-- TITLE -->
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">

                        {{ $service->name }}

                    </h1>

                    <!-- DESCRIPTION -->
                    <p class="text-gray-500 text-lg leading-relaxed mb-8">

                        {{ $service->description }}

                    </p>

                    <!-- FEATURES -->
                    <div class="grid grid-cols-2 gap-4 mb-10">

                        <div class="bg-gray-100 rounded-2xl p-4">

                            <p class="text-sm text-gray-500 mb-1">

                                Service Type

                            </p>

                            <h3 class="font-bold text-gray-800">

                                Premium

                            </h3>

                        </div>

                        <div class="bg-gray-100 rounded-2xl p-4">

                            <p class="text-sm text-gray-500 mb-1">

                                Availability

                            </p>

                            <h3 class="font-bold text-green-600">

                                Available

                            </h3>

                        </div>

                        <div class="bg-gray-100 rounded-2xl p-4">

                            <p class="text-sm text-gray-500 mb-1">

                                Booking Status

                            </p>

                            <h3 class="font-bold text-blue-600">

                                Open

                            </h3>

                        </div>

                        <div class="bg-gray-100 rounded-2xl p-4">

                            <p class="text-sm text-gray-500 mb-1">

                                Support

                            </p>

                            <h3 class="font-bold text-gray-800">

                                24/7

                            </h3>

                        </div>

                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="flex flex-col sm:flex-row gap-4">

                    <!-- BOOK NOW -->
                    <a href="{{ route('booking.create') }}?service={{ $service->id }}"
                       class="flex-1 text-center
                              bg-blue-600 hover:bg-blue-700
                              text-white py-4 rounded-2xl
                              font-semibold transition">

                        Book Now

                    </a>

                    <!-- MY BOOKINGS -->
                    <a href="{{ route('booking.history') }}"
                       class="flex-1 text-center
                              border border-gray-300
                              hover:bg-gray-100
                              py-4 rounded-2xl
                              font-semibold transition">

                        My Bookings

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
