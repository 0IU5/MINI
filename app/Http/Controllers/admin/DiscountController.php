<?php

namespace App\Http\Controllers\admin;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mulai query untuk PromoCode
        $query = PromoCode::query();

        // Filter pencarian berdasarkan kode promo (pastikan kolom ini ada di tabel Anda)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('code', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan diskon
        if ($request->has('price_discount') && in_array($request->price_discount, ['asc', 'desc'])) {
            $query->orderBy('discount_amount', $request->price_discount);
        }

        // Filter berdasarkan kuantitas
        if ($request->has('kuantitas') && in_array($request->kuantitas, ['asc', 'desc'])) {
            $query->orderBy('quantity', $request->kuantitas);
        }

        // Filter berdasarkan minimal pembelian
        if ($request->has('minimal_pembelian') && in_array($request->minimal_pembelian, ['asc', 'desc'])) {
            $query->orderByRaw('CAST(minimum_purchase AS DECIMAL) ' . $request->minimal_pembelian);
        }

        // Ambil data dengan pagination (misalnya 5 data per halaman)
        $codes = $query->paginate(1);

        // Kirim data ke view
        return view('admin.discount.index', compact('codes'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $input = $request->validate([
            'code' => 'required|unique:promo_codes,code',
            'discount_amount' => 'required|numeric',
            'quantity' => 'required|integer',
            'minimum_purchase' => 'required|numeric|min:0', // Validasi untuk minimal pembelian
            'discount_amount' => 'required|numeric|min:0|lte:minimum_purchase', // Validasi jumlah diskon tidak boleh lebih besar dari minimal pembelian
        ],[
            'code.required' => 'Kode promo wajib diisi.',
            'code.unique' => 'Kode promo sudah digunakan.',
            'discount_amount.required' => 'Jumlah diskon promo wajib diisi.',
            'discount_amount.lte' => 'Jumlah diskon tidak boleh lebih besar dari minimal pembelian.',
            'quantity.required' => 'Kuantitas promo wajib diisi.',
            'minimum_purchase.required' => 'Minimal pembelian promo wajib diisi.',
        ]);


        // Menambahkan promo code baru ke dalam database
        PromoCode::create($input);

        return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail promo jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promo = PromoCode::findOrFail($id);
        return view('admin.discount.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promo = PromoCode::findOrFail($id);

        // Validasi input
        $input = $request->validate([
            'code' => 'required|unique:promo_codes,code,' . $id,
            'discount_amount' => 'required|numeric',
            'quantity' => 'required|integer',
            'minimum_purchase' => 'required|numeric|min:0', // Validasi untuk minimal pembelian
            'discount_amount' => 'required|numeric|min:0|lte:minimum_purchase', // Validasi jumlah diskon tidak boleh lebih besar dari minimal pembelian
        ],[
            'code.required' => 'Kode promo wajib diisi.',
            'code.unique' => 'Kode promo sudah digunakan.',
            'discount_amount.required' => 'Jumlah diskon promo wajib diisi.',

            'discount_amount.lte' => 'Jumlah diskon tidak boleh lebih besar dari minimal pembelian.',
            'quantity.required' => 'Kuantitas promo wajib diisi.',
            'minimum_purchase.required' => 'Minimal pembelian promo wajib diisi.',
        ]);

        // Update promo code
        $promo->update($input);

        return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */


public function destroy(string $id)
{
    try {
        // Cari data promo berdasarkan ID
        $promo = PromoCode::findOrFail($id);

        // Set promo_code_id menjadi NULL di tabel orders
        DB::table('orders')->where('promo_code_id', $promo->id)->update(['promo_code_id' => null]);

        // Hapus promo code
        $promo->delete();

        return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil dihapus.');
    } catch (\Throwable $th) {
        return redirect()->route('admin.discount.index')->with('error', 'Promo tidak dapat dihapus.');
    }
}

}
