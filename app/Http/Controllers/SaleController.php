<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        if(auth()->user()->is_admin) {
            $sales = DB::table('sales')
                ->select('users.name', 'products.title', 'sales.quantity', 'sales.price')
                ->leftJoin('products','sales.product_id','=','products.id')
                ->leftJoin('users','sales.user_id','=','users.id')
                ->get();
        } else {
            $sales = DB::table('sales')
                ->select('users.name', 'products.title', 'sales.quantity', 'sales.price')
                ->leftJoin('products','sales.product_id','=','products.id')
                ->leftJoin('users','sales.user_id','=','users.id')
                ->where('users.id','=',auth()->user()->id)
                ->get();
        }

        return view('sales.index', compact('sales'));
    }

    public function create($id): View
    {
        $product = Product::findOrFail($id);
        return view('sales.create', compact('product'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'max:128'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'decimal:2'],
        ]);
        $product = Product::findOrFail($id);
        $data = [
            'quantity' => $request->get('quantity'),
            'price' => $request->get('price'),
            'user_id' => auth()->user()->id,
            'product_id' => $id
        ];
        if($product->quantity > $request->get('quantity')) {
            Sale::create($data);
            $product->quantity = $product->quantity -  $request->get('quantity');
            $product->save();
        }
        return to_route('sales.index');
    }
}
