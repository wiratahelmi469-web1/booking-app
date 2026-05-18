@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- BACK BUTTON -->
    <div class="mb-6">

        <a href="{{ route('services.index') }}"
           class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">

            ← Back to Services

        </a>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            <!-- IMAGE -->
            <div class="h-[350px] lg:h-full overflow-hidden">

                @if($service->image)

                    <img src="{{ asset('storage/'.$service->image) }}"
                         alt="{{ $service->name }}"
                         class="w-full h-full object-cover">

                @else

                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xl">

                        No Image

                    </div>

                @endif

            </div>

            <!-- CONTENT -->
            <div class="p-8 lg:p-12 flex flex-col justify-between">

                <div>

                    <!-- TITLE -->
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">

                        {{ $service->name }}

                    </h1>

                    <!-- PRICE -->
                    <p class="text-3xl font-bold text-blue-600 mb-6">

                        Rp {{ number_format($service->price) }}

                    </p>

                    <!-- DESCRIPTION -->
                    <div class="text-gray-600 leading-relaxed text-lg mb-8">

                        {{ $service->description }}

                    </div>

                </div>

                <!-- ACTION -->
                <div class="flex flex-col sm:flex-row gap-4">

                    <!-- BOOK NOW -->
                    <a href="{{ route('booking.create') }}?service={{ $service->id }}"
                       class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-semibold transition">

                        Book Now

                    </a>

                    <!-- HISTORY -->
                    <a href="{{ route('booking.history') }}"
                       class="flex-1 text-center border border-gray-300 hover:bg-gray-100 py-4 rounded-2xl font-semibold transition">

                        My Bookings

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
