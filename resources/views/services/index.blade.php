@extends('layouts.user')

@section('content')

<div class="mb-10">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-gray-800 mb-2">

            Discover Services ✨

        </h1>

        <p class="text-gray-500 text-lg">

            Find and book the best services easily.

        </p>

    </div>

    <!-- SEARCH -->
    <div class="bg-white rounded-2xl shadow-lg p-5 mb-10">

        <input type="text"
               placeholder="Search services..."
               class="w-full border-0 focus:ring-0 text-lg">

    </div>

    <!-- SERVICES GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @forelse($services as $service)

        <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 group">

            <!-- IMAGE -->
            <div class="relative overflow-hidden h-64">

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
                <div class="absolute top-4 right-4 bg-white px-4 py-2 rounded-full shadow font-bold text-blue-600">

                    Rp {{ number_format($service->price) }}

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

        <div class="col-span-3">

            <div class="bg-white rounded-3xl p-10 text-center shadow">

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

</div>

@endsection
