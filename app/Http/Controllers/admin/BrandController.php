<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Mendapatkan semua data brand dengan pagination
    $brands = Brand::when($request->input('search'), function ($query, $search) {
            $query->where('name_brand', 'like', '%' . $search . '%');
        })
        ->when($request->input('sort_order'), function ($query, $sortOrder) {
            if ($sortOrder === 'terlama') {
                return $query->orderBy('created_at', 'asc');
            }
            return $query->orderBy('created_at', 'desc');
        })
        ->paginate(1); // Menggunakan paginate dengan 10 item per halaman

    return view('admin.brands.index', compact('brands'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan brand baru
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_brand' => 'required|string|max:255|unique:brands,name_brand',
            'image_brand' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name_brand.required' => 'Nama brand wajib diisi.',
            'name_brand.unique' => 'Nama brand sudah digunakan.',
            'image_brand.nullable' => 'Gambar brand wajib diisi.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_brand')) {
            $imagePath = $request->file('image_brand')->store('brands', 'public');
        }

        Brand::create([
            'name_brand' => $request->name_brand,
            'image_brand' => $imagePath,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        // Menampilkan form untuk mengedit brand
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        // Validasi input
        $request->validate([
            'name_brand' => 'required|string|max:255|unique:brands,name_brand,' . $brand->id,
            'image_brand' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'name_brand.required' => 'Nama brand wajib diisi.',
        ]);

        // Variabel untuk menyimpan path gambar baru jika ada
        $imagePath = $brand->image_brand; // Default ke gambar lama

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('image_brand')) {
            // Hapus gambar lama jika ada
            if ($brand->image_brand && Storage::disk('public')->exists($brand->image_brand)) {
                Storage::disk('public')->delete($brand->image_brand);
            }

            // Simpan gambar baru dan perbarui path-nya
            $imagePath = $request->file('image_brand')->store('brand', 'public');
        }

        // Perbarui data brand lainnya, kecuali gambar
        $brand->update($request->except('image_brand'));

        // Simpan gambar baru jika ada
        $brand->image_brand = $imagePath;
        $brand->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Cek apakah brand masih memiliki produk terkait
        if ($brand->products()->exists()) {
            return redirect()->route('admin.brands.index')->with('error', 'Brand tidak bisa dihapus karena masih memiliki produk terkait.');
        }

        // Hapus brand dari database
        $brand->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil dihapus.');
    }

}
