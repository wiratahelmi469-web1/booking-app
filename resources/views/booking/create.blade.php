@extends('layouts.user')

@section('content')

<!-- HEADER -->
<div class="mb-10">

    <h1 class="text-4xl font-bold text-gray-800 mb-2">

        Explore Services ✨

    </h1>

    <p class="text-gray-500 text-lg">

        Choose the perfect service for your booking.

    </p>

</div>

<!-- SEARCH -->
<div class="bg-white rounded-2xl shadow-lg p-5 mb-10">

    <form method="GET"
          action="/booking">

        <div class="flex flex-col md:flex-row gap-4">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search services..."
                   class="flex-1 border border-gray-200 rounded-xl px-5 py-4 focus:ring-2 focus:ring-blue-500">

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl transition">

                Search

            </button>

        </div>

    </form>

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

                <!-- FORM -->
                <form method="POST"
                      action="{{ route('booking.store') }}">

                    @csrf

                    <input type="hidden"
                           name="service_id"
                           value="{{ $service->id }}">

                    <!-- DATE -->
                    <input type="date"
                           name="booking_date"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 mb-4"
                           required>

                    <!-- NOTES -->
                    <textarea name="notes"
                              rows="3"
                              placeholder="Notes..."
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 mb-4"></textarea>

                    <!-- BUTTON -->
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-semibold transition">

                        Book Now

                    </button>

                </form>

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
