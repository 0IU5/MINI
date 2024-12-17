@extends('layouts.admin')

@section('main')
    <div class="container mx-auto p-6">
        <div class="card w-full">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Table Actions -->
            <div class="flex justify-between items-center mb-4">
                <!-- Tombol Tambahkan Pengguna Baru -->
                <button class="btn btn-primary text-white py-2 px-4 rounded-lg" data-bs-toggle="modal"
                    data-bs-target="#tambahModal">
                    + Tambahkan Pengguna Baru
                </button>
            </div>

            <!-- Tombol Hapus Semua (Pindah ke bawah) -->
            <div class="flex justify-between items-center mb-4">
                <form action="{{ route('admin.users.index') }}" method="POST" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="selected_users" id="selected_users">
                    <button type="button" class="bg-red-500 text-white py-1 px-3 rounded-md" id="delete-all-button">Hapus
                        Semua</button>
                </form>

                <!-- Filter Role di Pojok Kanan -->
                <form action="{{ route('admin.users.index') }}" method="GET" id="roleFilterForm"
                    class="inline-block ml-auto">
                    <select name="role" id="role" class="form-select text-center" onchange="this.form.submit()">
                        <option value="">Semua Peran</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full bg-white table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-purple-600" id="select-all">
                            </th>
                            <th class="px-4 py-2 text-left">Pengguna</th>
                            <th class="px-4 py-2 text-left">Peran Pengguna</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 cursor-pointer border-b">
                                <td class="px-4 py-2">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-purple-600 checkbox-user"
                                        value="{{ $user->id }}">
                                </td>
                                <td class="px-4 py-2 flex items-center">
                                    <img src="https://via.placeholder.com/40" alt="User Avatar"
                                        class="w-8 h-8 rounded-full mr-3">
                                    <span>{{ $user->name }}</span>
                                </td>
                                <td class="px-4 py-2">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="bg-[#5d85fa] text-white py-1 px-2 rounded-lg text-sm">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2">
                                    <span class="bg-green-600 text-white py-1 px-2 rounded-lg text-sm">Aktif</span>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <button class="bg-red-600 text-white px-3 py-1 rounded" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $user->id }}">
                                        <i class="fa fa-trash text-white"></i>
                                        <!-- Menggunakan ikon trash dari Font Awesome -->
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="hapusModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="hapusModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus <strong>{{ $user->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
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

    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.querySelectorAll('.checkbox-user');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }

        function getSelectedUsers() {
            var selected = [];
            var checkboxes = document.querySelectorAll('.checkbox-user:checked');
            for (var checkbox of checkboxes) {
                selected.push(checkbox.value);
            }
            return selected;
        }

        document.getElementById('delete-all-button').onclick = function() {
            var selectedUsers = getSelectedUsers();
            if (selectedUsers.length > 0) {
                if (confirm('Are you sure you want to delete selected users?')) {
                    document.getElementById('delete-form').submit();
                }
            } else {
                alert('Please select at least one user to delete.');
            }
        }
    </script>
@endsection
