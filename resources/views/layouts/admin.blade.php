<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zen Tech') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    {{-- font awesome start --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- font awesome end --}}


    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logoo.png') }}" />
    <link rel="stylesheet" href="{{ asset('style/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('loading/loading.css') }}" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Style dasar header */
        .app-header {
            transition: box-shadow 0.3s ease;
            /* Menambahkan transisi halus untuk perubahan shadow */
        }

        /* Shadow saat di-scroll */
        .app-header.scrolled {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Gaya shadow yang akan muncul setelah scroll */
        }
    </style>
</head>

<body class="bg-gray-100">
    <div id="loader">
        <img src="{{ asset('img/logo2.png') }}" alt="Loading...">
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('layouts.adminbar')

        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            <header id="app-header" class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <!-- Notification Icon -->
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="notificationDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- SVG for Notification Icon -->
                                    <i class="fa-regular fa-bell"></i>

                                    @if ($unreadNotifications->count() > 0)
                                        <span class="relative flex h-4 w-4 -translate-y-2 -translate-x-1">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-white text-[10px] flex items-center justify-center">
                                                {{ $unreadNotifications->count() }}
                                            </span>
                                        </span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up rounded-lg shadow-lg bg-white border border-gray-200 w-96"
                                    aria-labelledby="notificationDropdown">
                                    <div class="notification-list max-h-80 overflow-y-auto p-4">
                                        @forelse($unreadNotifications as $notification)
                                            <a href="{{ route('admin.orders.show', $notification->order->id) }}"
                                                class="dropdown-item border-b last:border-0 py-3 px-2 hover:bg-gray-100 rounded-lg transition-all duration-200"
                                                data-order-id="{{ $notification->order_id }}">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="flex-shrink-0">
                                                        <!-- Icon or Avatar for the User (optional) -->
                                                        <i class="fa-solid fa-user-circle text-2xl text-gray-500"></i>
                                                    </div>
                                                    <div class="flex-grow">
                                                        <h6 class="mb-1 text-sm font-medium text-gray-800">
                                                            {{ $notification->order->user->name }}</h6>
                                                        <p class="mb-1 text-xs text-gray-600">
                                                            @if ($notification->order->productOrders->count() > 1)
                                                                {{ $notification->order->productOrders->first()->product->name_product }}
                                                                <span class="text-secondary text-gray-600"
                                                                    style="font-size: 0.85em;">dan lainnya</span>
                                                            @else
                                                                {{ $notification->order->productOrders->first()->product->name_product }}
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-500">
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                            <div class="dropdown-item px-4 py-2">
                                                <p class="mb-0 text-muted text-center">Tidak ada orderan baru</p>
                                            </div>
                                        @endforelse
                                    </div>

                                    <!-- Link "Tandai Semua Sudah Dibaca" -->
                                    <div class="px-4 py-3 border-t border-gray-100 bg-gray-50 text-center">
                                        <form action="{{ route('admin.notifications.mark-all-as-read') }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-xs text-blue-500 hover:text-blue-700 font-medium">Tandai
                                                Semua Sudah Dibaca</button>
                                        </form>
                                    </div>
                                </div>
                            </li>

                            <!-- Profile Icon and Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up p-2"
                                    aria-labelledby="drop2" style="min-width: 250px;">
                                    <div class="d-flex align-items-center p-3 border-bottom">
                                        <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}"
                                            alt="" width="60" height="60" class="rounded-circle me-3">
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ Auth::user()->name }}</h6>
                                            <span class="text-muted">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                    <div class="message-body">
                                        <form action="{{ route('logout') }}" method="POST" class="my-2">
                                            @csrf
                                            <button type="submit"
                                                class="dropdown-item px-3 py-2 d-flex align-items-center gap-2 text-danger">
                                                <i class="ti ti-logout fs-6"></i>
                                                <p class="mb-0 fs-3">Logout</p>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Header End -->
            <div class="container-fluid">
                @yield('main')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            // Toast Notification
            Swal.fire({
                toast: true,
                position: 'top-end', // Pojok kanan atas
                icon: 'success',
                iconColor: '#3b82f6', // Biru-500 dari Tailwind CSS
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#eff6ff', // Warna latar belakang biru muda
            });
        </script>
    @endif

    <script>
        // Menambahkan event listener untuk scroll
        window.addEventListener('scroll', function() {
            const header = document.getElementById('app-header');

            if (window.scrollY > 10) { // Jika scroll lebih dari 10px
                header.classList.add('scrolled'); // Tambahkan kelas .scrolled untuk shadow
            } else {
                header.classList.remove('scrolled'); // Hapus kelas .scrolled jika scroll kembali ke atas
            }
        });
    </script>
    <script src="{{ asset('style/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('style/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('style/src/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('loading/loading.js') }}"></script>
    <script>
        // Update the JavaScript code
        document.addEventListener('DOMContentLoaded', function() {
            // Update selector to match the actual class in HTML
            document.querySelectorAll('.dropdown-item[data-order-id]').forEach(item => {
                item.addEventListener('click', function(e) {
                    const orderId = this.dataset.orderId;

                    // Fix template literal syntax
                    fetch(`/admin/notifications/mark-as-read/${orderId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove this notification item
                                this.remove();

                                // Update notification counter
                                const badge = document.querySelector(
                                    '#notificationDropdown .relative');
                                if (badge) {
                                    const countElement = badge.querySelector('span:last-child');
                                    const count = parseInt(countElement.textContent) - 1;
                                    if (count <= 0) {
                                        badge.remove();
                                    } else {
                                        countElement.textContent = count;
                                    }
                                }
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

</body>

</html>
