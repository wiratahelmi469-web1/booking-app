@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    My Bookings
</h1>

<div class="bg-white rounded-xl shadow p-6 overflow-x-auto">

    <table class="w-full">

        <thead>

            <tr class="border-b">

                <th class="text-left py-3">Service</th>
                <th class="text-left py-3">Booking Date</th>
                <th class="text-left py-3">Status</th>
                <th class="text-left py-3">Notes</th>

            </tr>

        </thead>

        <tbody>

            @forelse($bookings as $booking)

            <tr class="border-b">

                <!-- SERVICE -->
                <td class="py-3">

                    {{ $booking->service->name }}

                </td>

                <!-- DATE -->
                <td class="py-3">

                    {{ $booking->booking_date }}

                </td>

                <!-- STATUS -->
                <td class="py-3">

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

                    @endif

                </td>

                <!-- NOTES -->
                <td class="py-3">

                    {{ $booking->notes }}

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4"
                    class="text-center py-6 text-gray-400">

                    No bookings found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
