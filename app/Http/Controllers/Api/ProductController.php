<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with('category')->paginate(10);
            
            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Gagal mengambil data produk',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product)
            {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product)
            {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            // Check authorization - hanya user yang membuat product bisa update
            if ($product->user_id !== Auth::id()) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 403);
            }

            $validated = $request->validate([
                'name' => 'sometimes|string',
                'description' => 'sometimes|string',
                'price' => 'sometimes|numeric',
                'kategori_id' => 'sometimes|exists:kategoris,id',
            ]);

            $product->update($validated);

            Log::info('Update data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil diupdate!!',
                'data' => $product,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update product', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Error saat update product',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product)
            {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            // Check authorization
            if ($product->user_id !== Auth::id()) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 403);
            }

            $product->delete();

            Log::info('Delete data produk', [
                'id' => $id
            ]);

            return response()->json([
                'message' => 'Produk berhasil dihapus!!',
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat delete product', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Error saat delete product',
            ], 500);
        }
    }
}
