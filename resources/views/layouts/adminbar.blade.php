<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">

            <a href="{{ route('dashboard.index') }}" class=" flex justify-center items-center logo-img">
                <img src="{{ asset('img/logo&text.svg') }}" width="170"  alt="" />
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>

        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <li class="sidebar-item my-2">
                    <a class="sidebar-link " href="{{ route('dashboard.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-gauge"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                 {{-- dropdown produk --}}
                <div class="">
                    <button id="productMenuToggle"
                        class="w-full flex items-center justify-between {{ request()->routeIs('admin.products.index') ||
                        request()->routeIs('admin.categories.index') ||
                        request()->routeIs('admin.brands.index')
                            ? 'text-white bg-[#5D87FF] hover:bg-[#5D87FF]'
                            : 'text-[#2A3547] hover:bg-[rgba(219,234,254,0.5)]' }} hover:text-[#5D87FF] space-x-2 my-2 p-[10px] rounded-md  group">
                        <div class="flex items-center">
                            <span
                                style="color: {{ request()->routeIs('admin.products.index') ||
                                request()->routeIs('admin.categories.index') ||
                                request()->routeIs('admin.brands.index')
                                    ? '#ffffff'
                                    : '' }};"
                                class="hove">
                                <i class="fa-solid fa-shop"></i>
                            </span>

                            <span class="ml-4">Produk</span>
                        </div>
                        <svg id="productMenuChevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24"
                            style="fill: {{ request()->routeIs('admin.products.index') ||
                            request()->routeIs('admin.categories.index') ||
                            request()->routeIs('admin.brands.index')
                                ? '#ffffff'
                                : ' ' }}; 
                                    transition: transform 0.3s; 
                                    transform: {{ request()->routeIs('admin.products.index') ||
                                    request()->routeIs('admin.categories.index') ||
                                    request()->routeIs('admin.brands.index')
                                        ? 'rotate(180deg)'
                                        : 'rotate(0deg)' }};"
                            class="group-hover:fill-[#5D87FF]">
                            <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z">
                            </path>
                        </svg>
                    </button>

                    <div id="productSubMenu"
                        class="{{ request()->routeIs('admin.products.index') ||
                        request()->routeIs('admin.categories.index') ||
                        request()->routeIs('admin.brands.index')
                            ? ''
                            : 'hidden' }} pl-4 space-y-2 mt-2">
                        <a href="{{ route('admin.products.index') }}"
                            class="block text-sm  p-2 {{ request()->routeIs('admin.products.index')
                                ? 'text-[#5D87FF] font-semibold  bg-[rgba(219,234,254,0.5)] rounded-md'
                                : 'text-gray-700 hover:text-[#5D87FF]' }}">
                            <span>
                                <i class="fa-regular fa-circle"></i>
                            </span>

                            <span class="ml-4">List Produk</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="block text-sm  p-2 {{ request()->routeIs('admin.categories.index')
                                ? 'text-[#5D87FF] font-semibold  bg-[rgba(219,234,254,0.5)] rounded-md'
                                : 'text-gray-700 hover:text-[#5D87FF]' }}">
                             <span>
                                <i class="fa-regular fa-circle"></i>
                            </span>

                            <span class="ml-4">List Kategori</span>
                        </a>
                        <a href="{{ route('admin.brands.index') }}"
                            class="block text-sm  p-2 {{ request()->routeIs('admin.brands.index')
                                ? 'text-[#5D87FF] font-semibold  bg-[rgba(219,234,254,0.5)] rounded-md'
                                : 'text-gray-700 hover:text-[#5D87FF]' }}">
                             <span>
                                <i class="fa-regular fa-circle"></i>
                            </span>

                            <span class="ml-4"> List Merek</span>
                        </a>
                    </div>
                </div>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.orders.index') }}" aria-expanded="false">
                        <span>

                            <i class="fa-solid fa-dolly"></i>
                        </span>
                        <span class="hide-menu">Pesanan</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.discount.index') }}" aria-expanded="false">
                        <span> 
                            <i class="fa-solid fa-ticket"></i>
                        </span>
                        <span class="hide-menu">Voucher</span>
                    </a>
                </li>         
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.reviews.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-comments"></i>
                        </span>
                        <span class="hide-menu">Ulasan</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link " href="{{ route('admin.users.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="hide-menu">Pengguna</span>
                    </a>
                </li>
                <div class="">
                    <button id="settingMenuToggle"
                        class="w-full flex items-center justify-between {{ request()->routeIs('admin.carousel.index') 
                            ? 'text-white bg-[#5D87FF] hover:bg-[#5D87FF]'
                            : 'text-[#2A3547] hover:bg-[rgba(219,234,254,0.5)]' }} hover:text-[#5D87FF] space-x-2 my-2 p-[10px] rounded-md  group">
                        <div class="flex items-center">
                            <span
                                style="color: {{ request()->routeIs('admin.carousel.index')  
                                    ? '#ffffff'
                                    : '' }};"
                                class="hove">
                                <i class="fa-solid fa-gear"></i>
                            </span>

                            <span class="ml-4">Pengaturan</span>
                        </div>
                        <svg id="settingMenuChevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24"
                            style="fill: {{ request()->routeIs('admin.carousel.index') 
                                ? '#ffffff'
                                : ' ' }}; 
                                    transition: transform 0.3s; 
                                    transform: {{ request()->routeIs('admin.carousel.index')
                                        ? 'rotate(180deg)'
                                        : 'rotate(0deg)' }};"
                            class="group-hover:fill-[#5D87FF]">
                            <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z">
                            </path>
                        </svg>
                    </button>

                    <div id="settingSubMenu"
                        class="{{ request()->routeIs('admin.carousel.index')
                            ? ''
                            : 'hidden' }} pl-4 space-y-2 mt-2">
                        <a href="{{ route('admin.carousel.index') }}"
                            class="block text-sm  p-2 {{ request()->routeIs('admin.carousel.index')
                                ? 'text-[#5D87FF] font-semibold  bg-[rgba(219,234,254,0.5)] rounded-md'
                                : 'text-gray-700 hover:text-[#5D87FF]' }}">
                            <span>
                                <i class="fa-regular fa-circle"></i>
                            </span>

                            <span class="ml-4">Banner</span>
                        </a>
                    </div>
                </div>   
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</aside>

<script>
    // Script untuk expandable menu Akun Saya
    const productMenuToggle = document.getElementById('productMenuToggle');
    const productSubMenu = document.getElementById('productSubMenu');
    const productMenuChevron = document.getElementById('productMenuChevron');

    productMenuToggle.addEventListener('click', () => {
        // Toggle submenu
        productSubMenu.classList.toggle('hidden');

        // Rotate chevron
        productMenuChevron.style.transform = productSubMenu.classList.contains('hidden') ?
            'rotate(0deg)' :
            'rotate(180deg)';
    });
</script>
<script>
    // Script untuk expandable menu Akun Saya
    const settingMenuToggle = document.getElementById('settingMenuToggle');
    const settingSubMenu = document.getElementById('settingSubMenu');
    const settingMenuChevron = document.getElementById('settingMenuChevron');

    settingMenuToggle.addEventListener('click', () => {
        // Toggle submenu
        settingSubMenu.classList.toggle('hidden');

        // Rotate chevron
        settingMenuChevron.style.transform = settingSubMenu.classList.contains('hidden') ?
            'rotate(0deg)' :
            'rotate(180deg)';
    });
</script>
