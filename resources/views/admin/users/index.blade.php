@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="flex flex-col md:flex-row mb-4 gap-4">
                <!-- Banner -->
                <div class="w-full md:w-3/4 bg-blue-500 bg-opacity-20 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <!-- Kiri: Judul dan Breadcrumb -->
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-800">Daftar Penggunna</h1>
                            <nav class="mt-2">
                                <ol class="flex text-sm text-gray-600">
                                    <li><a href="{{ route('dashboard.index') }}" class="hover:text-blue-500">Dashboard</a>
                                    </li>
                                    <li class="mx-2">/</li>
                                    <li><a href="{{ route('admin.users.index') }}" class="hover:text-blue-500"> Penggunna</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Kanan: Gambar (Vector) -->
                        <div class="hidden md:block">
                            <img src="{{ asset('img/img-banner/pengguna.png') }}" alt="Gambar Banner"
                                class="w-32 h-32 object-contain">
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="w-full md:w-1/4 bg-gradient-to-r from-blue-800 to-blue-400 p-2 rounded-lg shadow-md">
                    <div class="flex flex-col items-center">
                        <!-- Ikon di atas dengan latar belakang putih dan tinggi penuh -->
                        <div class="bg-white p-4 rounded-md h-16 w-16 flex justify-center items-center w-full">
                            <i class="fa-solid fa-users text-3xl text-blue-600"></i>
                        </div>
                        <!-- Keterangan di bawah ikon -->
                        <div class="mt-4 text-center">
                            <h2 class="text-xl font-medium text-white">Jumlah Penggunna</h2>
                            <p class="text-2xl font-semibold text-white mt-2">{{ $users->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-full">
                <div class="card-body p-4">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <!-- Pencarian -->
                                <form action="{{ route('admin.users.index') }}" method="GET" class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="search"
                                            class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari Nama Pengguna"
                                            value="{{ request('search') }}" style="width: 200px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="flex items-center gap-4">
                                <button class="btn btn-primary text-white py-2 px-4 rounded-lg" data-bs-toggle="modal"
                                    data-bs-target="#tambahModal">
                                    + Tambahkan admin baru
                                </button>
                                <!-- Filter Kategori -->
                                <form id="filterForm" action="{{ route('admin.users.index') }}" method="GET">
                                    <div class="d-flex align-items-center">
                                        <select name="role" id="role"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            style="width: 200px;"
                                            onchange="document.getElementById('filterForm').submit();">
                                            <option value="">Semua Peran</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"{{
                                                    request('role') == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                                <thead class="bg-[#5D87FF] text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Gambar</th>
                                        <th class="px-4 py-2 text-left">Pengguna</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-left">Peran</th>
                                        <th class="px-4 py-2 text-left">Bergabung</th>
                                        <th class="px-4 py-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="hover:bg-gray-50 border-b">
                                            <td class="px-4 py-2">
                                                @if ($user->image)
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture"
                                                        class="w-10 h-10 rounded-full mr-3">
                                                @else
                                                    <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }} "
                                                        alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                <span>{{ $user->name }}</span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <span>{{ $user->email }}</span>
                                            </td>
                                            <td class="px-4 py-2">
                                                @foreach ($user->roles as $role)
                                                <span class="inline-flex items-center
                                                    @if($role->name === 'admin') bg-blue-200 text-primary @elseif($role->name === 'user') bg-green-200 text-green-600 @else bg-gray-100 bg-opacity-50 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif
                                                    text-xs font-medium px-3 py-1 rounded-full">
                                                    <span class="w-2 h-2 me-1
                                                        @if($role->name === 'admin') bg-blue-500 @elseif($role->name === 'user') bg-green-500  @else bg-gray-500  @endif
                                                        rounded-full"></span>
                                                    {{ ucfirst($role->name) }}
                                                </span>
                                                @endforeach
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $user->joinDate }}
                                            </td>
                                            <td class="px-4 py-2">
                                                @if ($user->hasRole('admin')) <!-- Only show for admin role -->
                                                    <button class="btn btn-warning text-white" data-bs-toggle="modal"
                                                            data-bs-target="#changePasswordModal-{{ $user->id }}">
                                                        Ganti Password
                                                    </button>
                                                @else
                                                    <span class="text-gray-500"></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="h-64">
                                                <div class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                                    <img src="{{ asset('img/empty-data.png') }}" alt=" Tidak Ditemukan"
                                                        class="w-64 h-64">
                                                    <p class="text-lg text-gray-600 font-medium">Tidak ada produk</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ganti Password -->
    @foreach($users as $user)
        @if($user->hasRole('admin')) <!-- Only show modal for admin users -->
            <div class="modal fade" id="changePasswordModal-{{ $user->id }}" tabindex="-1" aria-labelledby="changePasswordModalLabel-{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordModalLabel-{{ $user->id }}">Ganti Password Pengguna: {{ $user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.users.changePassword', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection
