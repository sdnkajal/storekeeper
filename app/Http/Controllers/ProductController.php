<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $products = Product::all();
        return view('products.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:128'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'decimal:2'],
        ]);
        $data = [
            'title' => $request->get('title'),
            'quantity' => $request->get('quantity'),
            'price' => $request->get('price'),
            'user_id' => auth()->user()->id
        ];
        Product::create($data);
        return redirect()->back();
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'max:128'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'decimal:2'],
        ]);
        $product = Product::findOrFail($id);
        $product->title = $request->get('title');
        $product->quantity = $request->get('quantity');
        $product->price = $request->get('price');
        $product->save();
        return view('products.edit', compact('product'));
    }
}
