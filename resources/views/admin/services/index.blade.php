@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Services
    </h1>

    <a href="/admin/services/create"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">

        + Add Service

    </a>

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

        <thead>

            <tr class="border-b">

                <th class="text-left py-3">Image</th>
                <th class="text-left py-3">Name</th>
                <th class="text-left py-3">Price</th>
                <th class="text-left py-3">Action</th>

            </tr>

        </thead>

        <tbody>

            @forelse($services as $service)

            <tr class="border-b">

                <!-- IMAGE -->
                <td class="py-3">

                    @if($service->image)

                    <img src="{{ asset('storage/'.$service->image) }}"
                         class="w-20 h-20 object-cover rounded-lg">

                    @else

                    <span class="text-gray-400">
                        No Image
                    </span>

                    @endif

                </td>

                <!-- NAME -->
                <td class="py-3">

                    {{ $service->name }}

                </td>

                <!-- PRICE -->
                <td class="py-3">

                    Rp {{ number_format($service->price) }}

                </td>

                <!-- ACTION -->
                <td class="py-3">

                    <div class="flex gap-2">

                        <!-- EDIT -->
                        <a href="/admin/services/{{ $service->id }}/edit"
                           class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-500">

                            Edit

                        </a>

                        <!-- DELETE -->
                        <form action="/admin/services/{{ $service->id }}"
                              method="POST"
                              onsubmit="return confirm('Delete this service?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">

                                Delete

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4"
                    class="text-center py-6 text-gray-400">

                    No services found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
