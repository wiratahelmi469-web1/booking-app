@extends(
    auth()->user()->role === 'admin'
        ? 'layouts.admin'
        : 'layouts.user'
)

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- PROFILE CARD -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <!-- TOP HEADER -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 h-40 relative">

            <!-- PROFILE PHOTO -->
            <form method="POST"
                  action="{{ route('profile.photo') }}"
                  enctype="multipart/form-data"
                  class="absolute -bottom-16 left-1/2 -translate-x-1/2">

                @csrf

                <div class="relative">

                    <!-- PHOTO -->
                    @if(auth()->user()->profile_photo)

                        <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}"
                             alt="Profile Photo"
                             class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-2xl">

                    @else

                        <div class="w-40 h-40 rounded-full bg-blue-100
                                    flex items-center justify-center
                                    text-6xl font-bold text-blue-600
                                    border-4 border-white shadow-2xl">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                    @endif

                    <!-- HIDDEN INPUT -->
                    <input type="file"
                           name="profile_photo"
                           id="profile_photo"
                           class="hidden"
                           onchange="this.form.submit()">

                    <!-- EDIT BUTTON -->
                    <label for="profile_photo"
                           class="absolute bottom-2 right-2
                                  w-12 h-12 rounded-full
                                  bg-blue-600 hover:bg-blue-700
                                  text-white flex items-center justify-center
                                  shadow-lg cursor-pointer
                                  transition duration-200">

                        ✏️

                    </label>

                </div>

            </form>

        </div>

        <!-- CONTENT -->
        <div class="pt-24 p-10">

            <!-- USER INFO -->
            <div class="text-center mb-12">

                <h1 class="text-4xl font-bold text-gray-800 mb-3">

                    {{ auth()->user()->name }}

                </h1>

                <p class="text-lg text-gray-500">

                    {{ auth()->user()->email }}

                </p>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))

                <div class="mb-8 bg-green-100 text-green-700
                            px-6 py-4 rounded-2xl">

                    {{ session('success') }}

                </div>

            @endif

            <!-- UPDATE FORM -->
            <form method="POST"
                  action="{{ route('profile.update') }}">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- FULL NAME -->
                    <div>

                        <label class="block text-gray-700 font-semibold mb-3">

                            Full Name

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full border border-gray-200
                                      rounded-2xl px-5 py-4
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500">

                    </div>

                    <!-- EMAIL -->
                    <div>

                        <label class="block text-gray-700 font-semibold mb-3">

                            Email Address

                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full border border-gray-200
                                      rounded-2xl px-5 py-4
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500">

                    </div>

                    <!-- PASSWORD -->
                    <div>

                        <label class="block text-gray-700 font-semibold mb-3">

                            New Password

                        </label>

                        <input type="password"
                               name="password"
                               placeholder="Leave blank if unchanged"
                               class="w-full border border-gray-200
                                      rounded-2xl px-5 py-4
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500">

                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div>

                        <label class="block text-gray-700 font-semibold mb-3">

                            Confirm Password

                        </label>

                        <input type="password"
                               name="password_confirmation"
                               placeholder="Confirm your password"
                               class="w-full border border-gray-200
                                      rounded-2xl px-5 py-4
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500">

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-10">

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700
                                   text-white py-4 rounded-2xl
                                   font-semibold text-lg
                                   shadow-lg transition duration-200">

                        Save Changes

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
