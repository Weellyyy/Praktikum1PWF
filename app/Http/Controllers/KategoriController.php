<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $this->authorize('admin');
        $kategoris = Kategori::withCount('products')->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        $this->authorize('admin');
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:kategoris',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        $this->authorize('admin');
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $this->authorize('admin');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:kategoris,name,' . $kategori->id,
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
                        ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $this->authorize('admin');
        
        $kategori->delete();

        return redirect()->route('kategori.index')
                        ->with('success', 'Kategori berhasil dihapus.');
    }
}
