<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center gap-4 mb-8">
                        <a href="{{ route('product.show', $product) }}"
                           class="p-1.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">Edit Produk</h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Ubah informasi produk: <span class="font-medium text-gray-700">{{ $product->name }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- Delete Form (Hidden) --}}
                    <form id="delete-product-form" action="{{ route('product.delete', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>

                    {{-- Validation Alert --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        Terdapat {{ count($errors) }} kesalahan validasi:
                                    </p>
                                    <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('product.update', $product) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                                Nama Produk
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name"
                                   value="{{ old('name', $product->name) }}" 
                                   placeholder="Laptop, Mouse, Keyboard, dll"
                                   class="block w-full px-4 py-2.5 border rounded-lg text-gray-900 placeholder-gray-400 text-sm
                                   {{ $errors->has('name') ? 'border-red-500 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }}
                                   focus:outline-none focus:ring-1 focus:border-transparent transition">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Maksimal 255 karakter</p>
                        </div>

                        {{-- Quantity & Price --}}
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="qty" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Jumlah (Qty)
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       id="qty" 
                                       name="qty"
                                       value="{{ old('qty', $product->qty) }}" 
                                       placeholder="10"
                                       min="1"
                                       class="block w-full px-4 py-2.5 border rounded-lg text-gray-900 placeholder-gray-400 text-sm
                                       {{ $errors->has('qty') ? 'border-red-500 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }}
                                       focus:outline-none focus:ring-1 focus:border-transparent transition">
                                @error('qty')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Minimal 1 unit</p>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Harga Produk (Rp)
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       id="price" 
                                       name="price"
                                       value="{{ old('price', $product->price) }}" 
                                       placeholder="50000"
                                       min="0"
                                       step="0.01"
                                       class="block w-full px-4 py-2.5 border rounded-lg text-gray-900 placeholder-gray-400 text-sm
                                       {{ $errors->has('price') ? 'border-red-500 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }}
                                       focus:outline-none focus:ring-1 focus:border-transparent transition">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Tidak boleh negatif</p>
                            </div>
                        </div>

                        {{-- User --}}
                        <div>
                            <label for="user_id" class="block text-sm font-semibold text-gray-900 mb-2">
                                Pemilik Produk
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="user_id" 
                                    name="user_id"
                                    class="block w-full px-4 py-2.5 border rounded-lg text-gray-900 text-sm appearance-none
                                    {{ $errors->has('user_id') ? 'border-red-500 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }}
                                    focus:outline-none focus:ring-1 focus:border-transparent transition"
                                    style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20fill=%22none%22%20viewBox=%220%200%2024%2024%22%20stroke=%22currentColor%22%3E%3Cpath%20stroke-linecap=%22round%22%20stroke-linejoin=%22round%22%20stroke-width=%222%22%20d=%22M19%209l-7%207-7-7%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em; padding-right: 2.5rem;">
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                            {{ (old('user_id', $product->user_id) == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-8">
                            <button type="button"
                                    onclick="if(confirm('Yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')) { document.getElementById('delete-product-form').submit(); }"
                                    class="px-4 py-2.5 rounded-lg border border-red-300 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                                🗑 Hapus Produk
                            </button>

                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('product.index') }}"
                                   class="px-6 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                    Batal
                                </a>

                                <button type="submit"
                                        class="px-8 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-md transition">
                                    ✓ Perbarui
                                </button>
                            </div>
                        </div>
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Hapus
                            </button>

                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('product.index') }}"
                                   class="px-4 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                    Batal
                                </a>

                                <button type="submit"
                                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                    </svg>
                                    Perbarui
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>