<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; // Tambahkan ini
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian dari request
        $order = $request->input('sort_order', 'terbaru'); // Ambil input urutan, defaultnya 'terbaru'

        // Tentukan urutan berdasarkan pilihan pengguna
        $orderBy = $order === 'terlama' ? 'asc' : 'desc';

        // Query untuk mendapatkan data carousel dengan pencarian dan urutan
        $carousel = Carousel::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('created_at', $orderBy) // Urutkan berdasarkan created_at
            ->get();

        return view('admin.carousel.index', compact('carousel', 'search', 'order'));
    }


    public function create()
    {
        return view('admin.carousel.create'); // Perbaikan path view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desktop_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tablet_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'mobile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'title.required' => 'Judul wajib diisi',
            'desktop_image.required' => 'Gambar wajib diisi.',
            'desktop_image.required' => 'Gambar wajib format jpeg, png dan jpg.',
            'tablet_image.required' => 'Gambar wajib diisi.',
            'tablet_image.required' => 'Gambar wajib format jpeg, png dan jpg.',
            'mobile.required' => 'Gambar wajib diisi.',
            'mobile_image.required' => 'Gambar wajib format jpeg, png dan jpg.',
        ]);

        $desktop = $request->file('desktop_image')->store('carousel/desktop', 'public');
        $tablet = $request->file('tablet_image')->store('carousel/tablet', 'public');
        $mobile = $request->file('mobile_image')->store('carousel/mobile', 'public');

        Carousel::create([
            'title' => $request->title,
            'desktop_image' => $desktop,
            'tablet_image' => $tablet,
            'mobile_image' => $mobile,
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil ditambahkan.');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel')); // Perbaikan path view
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'title' => 'required',
            'desktop_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'tablet_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'mobile_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'title.required' => 'Judul wajib diisi',
            'desktop_image.required' => 'Gambar wajib diisi.',
            'desktop_image.required' => 'Gambar wajib format jpeg, png dan jpg.',
            'tablet_image.required' => 'Gambar wajib diisi.',
            'tablet_image.required' => 'Gambar wajib format jpeg, png dan jpg.',
            'mobile.required' => 'Gambar wajib diisi.',
            'mobile_image.required' => 'Gambar wajib format jpeg, png dan jpg.',
        ]);

        if ($request->hasFile('desktop_image')) {
            Storage::disk('public')->delete($carousel->desktop_image);
            $carousel->desktop_image = $request->file('desktop_image')->store('carousel/desktop', 'public');
        }

        if ($request->hasFile('tablet_image')) {
            Storage::disk('public')->delete($carousel->tablet_image);
            $carousel->tablet_image = $request->file('tablet_image')->store('carousel/tablet', 'public');
        }

        if ($request->hasFile('mobile_image')) {
            Storage::disk('public')->delete($carousel->mobile_image);
            $carousel->mobile_image = $request->file('mobile_image')->store('carousel/mobile', 'public');
        }

        $carousel->title = $request->title;
        $carousel->save();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil diperbarui.');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::disk('public')->delete([$carousel->desktop_image, $carousel->tablet_image, $carousel->mobile_image]);
        $carousel->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil dihapus.');
    }
}
