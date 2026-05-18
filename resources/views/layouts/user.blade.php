<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-blue-600 text-white p-6 shadow-lg">

            <!-- LOGO -->
            <div class="mb-10">

                <h1 class="text-3xl font-bold tracking-wide">

                    Booking App

                </h1>

                <p class="text-sm text-blue-100 mt-1">

                    User Panel

                </p>

            </div>

            <!-- MENU -->
            <nav class="space-y-2">

                <!-- DASHBOARD -->
                <a href="/dashboard"
                   class="block py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200">

                    Dashboard

                </a>

                <!-- BOOKING -->
                <a href="/booking"
                   class="block py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200">

                    Booking

                </a>

                <!-- MY BOOKINGS -->
                <a href="/my-bookings"
                   class="block py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200">

                    My Bookings

                </a>

            </nav>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col">

            <!-- NAVBAR -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

                <!-- LEFT -->
                <div>

                    <h2 class="text-2xl font-bold text-gray-800">

                        User Dashboard

                    </h2>

                    <p class="text-sm text-gray-500">

                        Welcome back 👋

                    </p>

                </div>

                <!-- RIGHT -->
                <div class="relative">

                    <!-- DROPDOWN BUTTON -->
                    <button id="dropdownButton"
                            type="button"
                            class="flex items-center gap-2 font-semibold text-gray-700 hover:text-gray-900 transition">

                        {{ auth()->user()->name }}

                        <!-- ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7" />

                        </svg>

                    </button>

                    <!-- DROPDOWN MENU -->
                    <div id="dropdownMenu"
                         class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg border overflow-hidden z-50">

                        <!-- ROLE -->
                        <div class="px-5 py-3 border-b bg-gray-50">

                            <p class="text-sm text-gray-500">

                                Logged in as

                            </p>

                            <p class="font-semibold text-gray-800 capitalize">

                                {{ auth()->user()->role }}

                            </p>

                        </div>

                        <!-- PROFILE -->
                        <a href="{{ route('profile') }}"
                           class="block px-5 py-3 hover:bg-gray-100 transition">

                            Profile

                        </a>

                        <!-- DIVIDER -->
                        <div class="border-t"></div>

                        <!-- LOGOUT -->
                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="w-full text-left px-5 py-3 text-red-500 hover:bg-red-50 transition">

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </header>

            <!-- PAGE CONTENT -->
            <section class="flex-1 p-6">

                @yield('content')

            </section>

            <!-- FOOTER -->
            <footer class="bg-white border-t px-6 py-4 text-center text-sm text-gray-500">

                 {{ date('Y') }} Booking App —
                Built with Laravel & Tailwind CSS

            </footer>

        </main>

    </div>

    <!-- DROPDOWN SCRIPT -->
    <script>

        const dropdownButton =
            document.getElementById('dropdownButton');

        const dropdownMenu =
            document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', () => {

            dropdownMenu.classList.toggle('hidden');

        });

        // CLOSE WHEN CLICK OUTSIDE
        window.addEventListener('click', function(e) {

            if (
                !dropdownButton.contains(e.target) &&
                !dropdownMenu.contains(e.target)
            ) {

                dropdownMenu.classList.add('hidden');

            }

        });

    </script>

</body>

</html>
