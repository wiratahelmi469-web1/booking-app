@extends('layouts.user')

@section('content')

<h1 class="text-3xl font-bold mb-8">

    Welcome, {{ auth()->user()->name }}

</h1>

<!-- MENU -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- BOOKING -->
    <a href="/booking"
       class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">

        <h2 class="text-2xl font-bold text-blue-500 mb-2">

            Book Service

        </h2>

        <p class="text-gray-500">

            Create a new booking.

        </p>

    </a>

    <!-- HISTORY -->
    <a href="/my-bookings"
       class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">

        <h2 class="text-2xl font-bold text-green-500 mb-2">

            My Bookings

        </h2>

        <p class="text-gray-500">

            View booking history.

        </p>

    </a>

</div>

@endsection
