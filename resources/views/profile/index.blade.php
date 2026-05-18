@extends(
    auth()->user()->role == 'admin'
        ? 'layouts.admin'
        : 'layouts.user'
)

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- TITLE -->
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-800">

            My Profile

        </h1>

        <p class="text-gray-500 mt-1">

            Manage your account information

        </p>

    </div>

    <!-- PROFILE CARD -->
    <div class="bg-white rounded-2xl shadow p-8">

        <!-- AVATAR -->
        <div class="flex justify-center mb-6">

            <div class="w-28 h-28 rounded-full bg-blue-100 flex items-center justify-center text-4xl font-bold text-blue-600">

                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

            </div>

        </div>

        <!-- USER INFO -->
        <div class="space-y-6">

            <!-- NAME -->
            <div>

                <label class="block text-sm font-semibold text-gray-600 mb-2">

                    Full Name

                </label>

                <input type="text"
                       value="{{ auth()->user()->name }}"
                       disabled
                       class="w-full border rounded-xl px-4 py-3 bg-gray-100">

            </div>

            <!-- EMAIL -->
            <div>

                <label class="block text-sm font-semibold text-gray-600 mb-2">

                    Email Address

                </label>

                <input type="text"
                       value="{{ auth()->user()->email }}"
                       disabled
                       class="w-full border rounded-xl px-4 py-3 bg-gray-100">

            </div>

            <!-- ROLE -->
            <div>

                <label class="block text-sm font-semibold text-gray-600 mb-2">

                    Role

                </label>

                <input type="text"
                       value="{{ auth()->user()->role }}"
                       disabled
                       class="w-full border rounded-xl px-4 py-3 bg-gray-100 capitalize">

            </div>

        </div>

    </div>

</div>

@endsection
