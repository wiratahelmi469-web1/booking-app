<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Booking App</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside id="sidebar"
        class="fixed md:sticky top-0 left-0
                h-screen w-64
                bg-gray-800 text-white p-6
                shadow-xl z-50
                transform -translate-x-full md:translate-x-0
                transition duration-300 ease-in-out">

            <!-- LOGO -->
            <div class="mb-10">

                <h1 class="text-3xl font-bold tracking-wide">

                    Booking App

                </h1>

                <p class="text-sm text-gray-400 mt-1">

                    Admin Panel

                </p>

            </div>

            <!-- MENU -->
            <nav class="space-y-2">

                <!-- DASHBOARD -->
                <a href="/admin/dashboard"
                   class="block py-3 px-4 rounded-xl hover:bg-gray-700 transition duration-200">

                    Dashboard

                </a>

                <!-- BOOKINGS -->
                <a href="/admin/bookings"
                   class="block py-3 px-4 rounded-xl hover:bg-gray-700 transition duration-200">

                    Bookings

                </a>

                <!-- SERVICES -->
                <a href="/admin/services"
                   class="block py-3 px-4 rounded-xl hover:bg-gray-700 transition duration-200">

                    Services

                </a>

            </nav>

        </aside>

        <!-- OVERLAY -->
        <div id="overlay"
             class="fixed inset-0 bg-black/50 z-40 hidden md:hidden">
        </div>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col">

            <!-- NAVBAR -->
            <header class="sticky top-0 z-40
                            bg-white/90 backdrop-blur-lg
                            shadow px-4 md:px-6 py-4
                            flex items-center justify-between">

                <!-- LEFT -->
                <div class="flex items-center gap-4">

                    <!-- MOBILE BUTTON -->
                    <button id="menuButton"
                            class="md:hidden">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7 text-gray-700"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />

                        </svg>

                    </button>

                    <!-- TITLE -->
                    <div>

                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">

                            Admin Dashboard

                        </h2>

                        <p class="text-sm text-gray-500">

                            Welcome back 👋

                        </p>

                    </div>

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
                         class="hidden absolute right-0 mt-3 w-56
                                bg-white rounded-2xl shadow-xl
                                border overflow-hidden z-50">

                        <!-- ROLE -->
                        <div class="px-5 py-4 border-b bg-gray-50">

                            <p class="text-sm text-gray-500">

                                Logged in as

                            </p>

                            <p class="font-semibold text-gray-800 capitalize">

                                {{ auth()->user()->role }}

                            </p>

                        </div>

                        <!-- PROFILE -->
                        <a href="{{ route('profile') }}"
                           class="block px-5 py-4 hover:bg-gray-100 transition">

                            Profile

                        </a>

                        <!-- DIVIDER -->
                        <div class="border-t"></div>

                        <!-- LOGOUT -->
                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="w-full text-left px-5 py-4
                                           text-red-500 hover:bg-red-50 transition">

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </header>

            <!-- PAGE CONTENT -->
            <section class="flex-1 p-4 md:p-6">

                @yield('content')

            </section>

            <!-- FOOTER -->
            <footer class="bg-white border-t px-6 py-4 text-center text-sm text-gray-500">

                © {{ date('Y') }} Booking App —
                Built with Laravel & Tailwind CSS 🚀

            </footer>

        </main>

    </div>

    <!-- SCRIPT -->
    <script>

        // SIDEBAR
        const sidebar =
            document.getElementById('sidebar');

        const menuButton =
            document.getElementById('menuButton');

        const overlay =
            document.getElementById('overlay');

        menuButton.addEventListener('click', () => {

            sidebar.classList.remove('-translate-x-full');

            overlay.classList.remove('hidden');

        });

        overlay.addEventListener('click', () => {

            sidebar.classList.add('-translate-x-full');

            overlay.classList.add('hidden');

        });

        // DROPDOWN
        const dropdownButton =
            document.getElementById('dropdownButton');

        const dropdownMenu =
            document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', () => {

            dropdownMenu.classList.toggle('hidden');

        });

        // CLOSE DROPDOWN
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
