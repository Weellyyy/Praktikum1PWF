<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('product.index', compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        Product::create($validated);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product berhasil dibuat.');
    }


    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('product.create', compact('users'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // Check authorization dengan Policy
        $this->authorize('update', $product);

        $validated = $request->validated();
        $product->update($validated);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product berhasil diperbarui.');
    }

    public function edit(Product $product)
    {
        // Check authorization dengan Policy
        $this->authorize('update', $product);

        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Check authorization dengan Policy
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
    
}
