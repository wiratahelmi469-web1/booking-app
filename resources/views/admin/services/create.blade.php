@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Add Service
    </h1>

    <a href="/admin/services"
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">

        Back

    </a>

</div>

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

    <form action="/admin/services"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- NAME -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Service Name
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="w-full border rounded-lg px-4 py-2">

        </div>

        <!-- DESCRIPTION -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea name="description"
                      rows="5"
                      class="w-full border rounded-lg px-4 py-2">{{ old('description') }}</textarea>

        </div>

        <!-- PRICE -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Price
            </label>

            <input type="number"
                   name="price"
                   value="{{ old('price') }}"
                   class="w-full border rounded-lg px-4 py-2">

        </div>

        <!-- IMAGE -->
        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Image
            </label>

            <input type="file"
                   name="image"
                   class="w-full border rounded-lg px-4 py-2">

        </div>

        <!-- BUTTON -->
        <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">

            Save Service

        </button>

    </form>

</div>

@endsection
