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
        <aside class="w-64 bg-gray-900 text-white p-6 shadow-lg">

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
                   class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200">

                    Dashboard

                </a>

                <!-- BOOKINGS -->
                <a href="/admin/bookings"
                   class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200">

                    Bookings

                </a>

                <!-- MY BOOKINGS -->
                <a href="/my-bookings"
                   class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200">

                    My Bookings

                </a>

                <!-- SERVICES -->
                <a href="/admin/services"
                   class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200">

                    Services

                </a>

                <!-- USERS -->
                <a href="#"
                   class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200">

                    Users

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

                        Admin Dashboard

                    </h2>

                    <p class="text-sm text-gray-500">

                        Welcome back 👋

                    </p>

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    <!-- USER -->
                    <div class="text-gray-700 font-semibold">

                        {{ auth()->user()->name }}

                    </div>

                    <!-- LOGOUT -->
                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition duration-200">

                            Logout

                        </button>

                    </form>

                </div>

            </header>

            <!-- PAGE CONTENT -->
            <section class="flex-1 p-6">

                @yield('content')

            </section>

        </main>

    </div>

</body>

</html>
