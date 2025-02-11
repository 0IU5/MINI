<?php

namespace App\Http\Controllers\user;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Postage;
use App\Models\Product;
use App\Models\Province;
use App\Models\PromoCode;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

use App\Models\UsedPromoCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{

    public function __construct(Request $request)
    {
        // Set midtrans configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }



    public function index( Request $request)
    {
        $product = false;
        $carts = false;

        if ($request->input('product')) {
            $slug = $request->input('product');
            $product = Product::where('slug', $slug)->first();
            if (!$product || $product->stock_product <= 0) {
                return redirect()->route('page.product');
            }
        } else {
            $carts = Cart::where('user_id', Auth::id())->with('product');
            if ($request->input('cart')) {
                $carts = $carts->whereIn('id', explode('-', $request->input('cart')))->get();
                if (!$carts) {
                    return redirect()->route('page.product');
                }
            } else {
                $carts = $carts->get();
            }

            // Cek apakah ada produk yang stoknya habis di keranjang
            foreach ($carts as $cart) {
                if ($cart->product->stock_product <= 0) {
                    // Kirim nama produk yang stoknya habis ke dalam pesan error
                    return redirect()->route('user.carts.index')->with('error', 'Stok produk ' . $cart->product->name_product . ' telah habis.');
                }
            }

            if (count($carts) <= 0) {
                return redirect()->route('page.product');
            }
        }

        $addresses = Address::where('user_id', Auth::id())->get();
        $provinces = Province::relatedData();

        return view('user.checkout.index', compact('carts', 'product', 'addresses', 'provinces'));
    }
    public function store(Request $request)
    {
        $diskon = PromoCode::find($request->id_discount);
        // dd($request->all());
        $request->validate([
            'alamat' => 'required',
            'name' => 'required',
            'email' => 'required',
            // 'bukti_image' => 'required|image|mimes:jpeg,png,jpg',
            'id_discount' => 'nullable|exists:promo_codes,id',
            'total' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'addresses_id' => 'required|exists:addresses,id',
            'courier' => 'required',
            'cost' => 'required',
        ], [
            'alamat.required' => 'Alamat harus diisi',
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'total.required' => 'Total harus diisi',
            'total.numeric' => 'Total harus berupa angka',
            'total.min' => 'Total tidak boleh kurang dari 0',
            'subtotal.required' => 'Subtotal harus diisi',
            'subtotal.numeric' => 'Subtotal harus berupa angka',
            'subtotal.min' => 'Subtotal tidak boleh kurang dari 0',
            'addresses_id.required' => 'Alamat harus diisi',
            'addresses_id.exists' => 'Alamat tidak ditemukan',
            'courier.required' => 'Kurir harus diisi',
            'cost.required' => 'Biaya harus diisi',
        ]);


        $postage = Postage::create([
            'code' => $request->courier,
            'service' => $request->service,
            'ongkir_total_amount' => $request->cost,
        ]);

        // Buat data pesanan di tabel `orders`
        $order = Order::create([
            'user_id' => Auth::id(),
            'promo_code_id' => $diskon->id ?? null,
            'postage_id' => $postage->id,
            'addresses_id' => $request->addresses_id,
            'sub_total_amount' => $request->subtotal,
            'grand_total_amount' => $request->total,
        ]);


        $item_details = [];

        if ($request->order_form == 'cart') {
            $request->validate([
                'product_id_quantity' => 'required|array',
            ]);

            // Pindahkan item dari keranjang ke tabel `product_orders`
            foreach ($request->product_id_quantity as $product_id => $quantity) {
                ProductOrder::create([
                    'product_id' => $product_id,
                    'order_id' => $order->id,
                    'quantity' => $quantity,
                ]);

                $product =   Product::where('id', $product_id)->first();
                $product->decrement('stock_product', $quantity);

                $item_details[] =  [
                    'id'       => $product_id,
                    'price'    => $product->price_product,
                    'quantity' => $quantity,
                    'name'     => $product->name_product,
                ];
                Cart::where('user_id', Auth::id())->where('product_id', $product_id)->delete();
            }
            // Hapus data keranjang setelah checkout
        } else if ($request->order_form == 'product') {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity_checkout' => 'required|numeric|min:1',
            ]);
            $product = Product::where('id', $request->product_id)->first();
            if ($product->stock_product <= 0) {
                return response()->json(['status' => 'error', 'message' => 'Stock Product habis']);
            }
            ProductOrder::create([
                'product_id' => $request->product_id,
                'order_id' => $order->id,
                'quantity' => $request->quantity_checkout,
            ]);
            $product->decrement('stock_product', $request->quantity_checkout);


            $item_details[] =  [
                'id'       => $product->id,
                'price'    => $product->price_product,
                'quantity' => $request->quantity_checkout,
                'name'     => $product->name_product,
            ];
        } else {
            return response()->json(['status' => 'error', 'message' => 'Product tidak ditemukan']);
        }


        $item_details[] = [
            'id'       => 'Ongkir',
            'price'    => $request->cost,
            'quantity' => 1,
            'name'     => 'ongkir',
        ];

        $user = Auth::user();
        if ($diskon) {
            // Kurangi kuantitas kode promo
            $diskon->update([
                'quantity' => $diskon->quantity - 1
            ]);
            // Tandai kode promo sebagai digunakan oleh pengguna
            UsedPromoCode::create([
                'user_id' => $user->id,
                'promo_code_id' => $diskon->id,
            ]);

            $item_details[] = [
                'id'       => 'promo_discount',
                'price'    => -$diskon->discount_amount, // Nilai diskon negatif
                'quantity' => 1,
                'name'     => 'Promo Discount',
            ];
        }

        // $path = $request->file('bukti_image')->store('images/payments', 'public');

        // Buat transaksi ke midtrans kemudian save snap tokennya.
        $payload = [
            'transaction_details' => [
                'order_id'      => $order->id,
                'gross_amount'  => $request->total,
            ],
            'customer_details' => [
                'first_name'    => $request->name,
                'email'         => $request->email,
                'phone'         => $order->addresses->no_telepon,
                'address'       => $order->addresses->address,
            ],
            'item_details' => $item_details,
        ];

        $snapToken = Snap::getSnapToken($payload);
        $order->snap_token = $snapToken;
        $order->save();

        Payment::create([
            'order_id' => $order->id,
            'status' => 'pending',
        ]);

        return response()->json(['status' => 'success', 'snap_token' => $snapToken]);

        // Redirect ke halaman pesanan dengan pesan sukses
        return redirect()->route('user.orders.index')->with('success', 'Checkout berhasil! Pesanan Anda telah dibuat.');
    }

}
