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
        <aside id="sidebar"
               class="fixed md:static inset-y-0 left-0 z-50
                      w-64 bg-blue-600 text-white p-6
                      transform -translate-x-full md:translate-x-0
                      transition duration-300 ease-in-out">

            <!-- LOGO -->
            <div class="mb-10">

                <h1 class="text-3xl font-bold">

                    Booking App

                </h1>

                <p class="text-blue-100 mt-1">

                    User Panel

                </p>

            </div>

            <!-- MENU -->
            <nav class="space-y-3">

                <a href="/dashboard"
                   class="block py-3 px-4 rounded-xl hover:bg-blue-700 transition">

                    Dashboard

                </a>

                <a href="{{ route('services.index') }}"
                   class="block py-3 px-4 rounded-xl hover:bg-blue-700 transition">

                    services

                </a>

                <a href="/my-bookings"
                   class="block py-3 px-4 rounded-xl hover:bg-blue-700 transition">

                    My Bookings

                </a>

            </nav>

        </aside>

        <!-- OVERLAY MOBILE -->
        <div id="overlay"
             class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"></div>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col md:ml-0">

            <!-- NAVBAR -->
            <header class="bg-white shadow px-4 md:px-6 py-4
                           flex items-start md:items-center
                           justify-between">

                <!-- LEFT -->
                <div class="flex items-center gap-4">

                    <!-- HAMBURGER -->
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

                            User Dashboard

                        </h2>

                        <p class="text-sm text-gray-500">

                            Welcome back 👋

                        </p>

                    </div>

                </div>

                <!-- DROPDOWN -->
                <div class="relative">

                    <!-- BUTTON -->
                    <button id="dropdownButton"
                            class="flex items-center gap-2 text-gray-700 font-semibold">

                        {{ auth()->user()->name }}

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7" />

                        </svg>

                    </button>

                    <!-- MENU -->
                    <div id="dropdownMenu"
                         class="hidden absolute right-0 mt-3 w-56
                                bg-white rounded-2xl shadow-xl
                                border overflow-hidden z-50">

                        <!-- USER INFO -->
                        <div class="px-5 py-4 border-b">

                            <p class="text-sm text-gray-500">

                                Logged in as

                            </p>

                            <p class="font-bold text-gray-800">

                                User

                            </p>

                        </div>

                        <!-- PROFILE -->
                        <a href="/profile"
                           class="block px-5 py-4 hover:bg-gray-100 transition">

                            Profile

                        </a>

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
            <footer class="bg-white border-t text-center py-4 text-sm text-gray-500">

                © {{ date('Y') }} Booking App —
                Built with Laravel & TailwindCSS 🚀

            </footer>

        </main>

    </div>

    <!-- SCRIPT -->
    <script>

        // SIDEBAR
        const menuButton =
            document.getElementById('menuButton');

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('overlay');

        menuButton.addEventListener('click', () => {

            sidebar.classList.toggle('-translate-x-full');

            overlay.classList.toggle('hidden');

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
