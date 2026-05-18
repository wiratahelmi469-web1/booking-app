@extends('layouts.user')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Booking Service
</h1>

<!-- SUCCESS -->
@if(session('success'))

<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">

    {{ session('success') }}

</div>

@endif

<!-- ERROR -->
@if ($errors->any())

<div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">

    <ul class="list-disc pl-5">

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white p-6 rounded-xl shadow">

    <form action="/booking"
          method="POST">

        @csrf

        <!-- SERVICE -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Select Service
            </label>

            <select name="service_id"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="">
                    Choose Service
                </option>

                @foreach($services as $service)

                <option value="{{ $service->id }}">

                    {{ $service->name }} -
                    Rp {{ number_format($service->price) }}

                </option>

                @endforeach

            </select>

        </div>

        <!-- DATE -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Booking Date
            </label>

            <input type="date"
                   name="booking_date"
                   class="w-full border rounded-lg px-4 py-2">

        </div>

        <!-- NOTES -->
        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Notes
            </label>

            <textarea name="notes"
                      rows="5"
                      class="w-full border rounded-lg px-4 py-2"></textarea>

        </div>

        <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">

            Submit Booking

        </button>

    </form>

</div>

@endsection
