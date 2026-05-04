<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Kategori::all();
            
            return response()->json([
                'message' => 'Kategori retrieved successfully',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Gagal mengambil data kategori',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|unique:kategoris',
                'description' => 'nullable|string',
            ]);

            $category = Kategori::create($validated);

            Log::info('Menambah data kategori', [
                'list' => $category
            ]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan!!',
                'data' => $category,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah kategori', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Error saat menambah kategori',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category)
            {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Kategori retrieved successfully',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Gagal mengambil data kategori',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category)
            {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|unique:kategoris,name,' . $id,
                'description' => 'nullable|string',
            ]);

            $category->update($validated);

            Log::info('Update data kategori', [
                'list' => $category
            ]);

            return response()->json([
                'message' => 'Kategori berhasil diupdate!!',
                'data' => $category,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update kategori', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Error saat update kategori',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category)
            {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            $category->delete();

            Log::info('Delete data kategori', [
                'id' => $id
            ]);

            return response()->json([
                'message' => 'Kategori berhasil dihapus!!',
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat delete kategori', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Error saat delete kategori',
            ], 500);
        }
    }
}
