@extends('layouts.user')

@section('content')

<!-- HERO -->
<div class="relative rounded-3xl overflow-hidden mb-10">

    <div class="h-[320px] bg-gradient-to-r from-blue-700 to-blue-500">

        <div class="absolute inset-0 bg-black/30"></div>

        <div class="relative z-10 h-full flex flex-col justify-center px-10">

            <h1 class="text-5xl font-bold text-white mb-4">

                Find Your Perfect Service ✨

            </h1>

            <p class="text-blue-100 text-lg max-w-2xl">

                Book premium services quickly and easily with modern experience.

            </p>

        </div>

    </div>

</div>

<!-- SEARCH -->
<div class="bg-white rounded-2xl shadow-xl p-5 mb-10">

    <div class="flex items-center gap-4">

        <input type="text"
               placeholder="Search services..."
               class="w-full border-0 focus:ring-0 text-lg">

        <button class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition">

            Search

        </button>

    </div>

</div>

<!-- SERVICES -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

    @forelse($services as $service)

        <!-- CARD -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300 group">

            <!-- IMAGE -->
            <div class="relative h-64 overflow-hidden">

                @if($service->image)

                    <img src="{{ asset('storage/'.$service->image) }}"
                         alt="{{ $service->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                @else

                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">

                        No Image

                    </div>

                @endif

                <!-- PRICE -->
                <div class="absolute top-4 right-4 bg-white shadow-lg px-4 py-2 rounded-full">

                    <span class="font-bold text-blue-600">

                        Rp {{ number_format($service->price) }}

                    </span>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-6">

                <!-- TITLE -->
                <h2 class="text-2xl font-bold text-gray-800 mb-3">

                    {{ $service->name }}

                </h2>

                <!-- DESCRIPTION -->
                <p class="text-gray-500 mb-6 line-clamp-3">

                    {{ $service->description }}

                </p>

                <!-- BUTTON -->
                <div class="flex gap-3">

                    <!-- DETAIL -->
                    <a href="{{ route('services.show', $service->id) }}"
                       class="flex-1 text-center border border-gray-300 py-3 rounded-xl hover:bg-gray-100 transition">

                        Details

                    </a>

                    <!-- BOOK -->
                    <a href="{{ route('booking.create') }}?service={{ $service->id }}"
                       class="flex-1 text-center bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition">

                        Book Now

                    </a>

                </div>

            </div>

        </div>

    @empty

        <!-- EMPTY -->
        <div class="col-span-full">

            <div class="bg-white rounded-3xl p-10 shadow text-center">

                <h2 class="text-2xl font-bold text-gray-700 mb-2">

                    No Services Available

                </h2>

                <p class="text-gray-500">

                    Please wait until admin adds new services.

                </p>

            </div>

        </div>

    @endforelse

</div>

@endsection
