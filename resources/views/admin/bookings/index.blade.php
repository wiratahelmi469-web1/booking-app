@extends('layouts.admin')

@section('content')

<!-- TITLE -->
<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">

        Booking List

    </h1>

</div>

<!-- SUCCESS MESSAGE -->
@if(session('success'))

    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">

        {{ session('success') }}

    </div>

@endif

<!-- TABLE -->
<div class="bg-white rounded-xl shadow p-6 overflow-x-auto">

    <table class="w-full">

        <!-- TABLE HEAD -->
        <thead>

            <tr class="border-b">

                <th class="text-left py-3">
                    User
                </th>

                <th class="text-left py-3">
                    Service
                </th>

                <th class="text-left py-3">
                    Date
                </th>

                <th class="text-left py-3">
                    Status
                </th>

                <th class="text-left py-3">
                    Action
                </th>

            </tr>

        </thead>

        <!-- TABLE BODY -->
        <tbody>

            @forelse($bookings as $booking)

                <tr class="border-b">

                    <!-- USER -->
                    <td class="py-4">

                        {{ $booking->user->name }}

                    </td>

                    <!-- SERVICE -->
                    <td class="py-4">

                        {{ $booking->service->name }}

                    </td>

                    <!-- DATE -->
                    <td class="py-4">

                        {{ $booking->booking_date }}

                    </td>

                    <!-- STATUS BADGE -->
                    <td class="py-4">

                        @if($booking->status == 'pending')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                Pending

                            </span>

                        @elseif($booking->status == 'approved')

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                Approved

                            </span>

                        @elseif($booking->status == 'completed')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Completed

                            </span>

                        @elseif($booking->status == 'cancelled')

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                Cancelled

                            </span>

                        @endif

                    </td>

                    <!-- ACTION -->
                    <td class="py-4">

                        <form action="{{ route('admin.bookings.status', $booking->id) }}"
                              method="POST">

                            @csrf
                            @method('PATCH')

                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="border rounded-lg px-3 py-2">

                                <option value="pending"
                                    {{ $booking->status == 'pending' ? 'selected' : '' }}>

                                    Pending

                                </option>

                                <option value="approved"
                                    {{ $booking->status == 'approved' ? 'selected' : '' }}>

                                    Approved

                                </option>

                                <option value="completed"
                                    {{ $booking->status == 'completed' ? 'selected' : '' }}>

                                    Completed

                                </option>

                                <option value="cancelled"
                                    {{ $booking->status == 'cancelled' ? 'selected' : '' }}>

                                    Cancelled

                                </option>

                            </select>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5"
                        class="text-center py-6 text-gray-400">

                        No bookings found

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
