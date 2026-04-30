<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-8">
                        <a href="{{ route('product.index') }}"
                           class="p-1.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>

                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">Tambah Produk Baru</h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Lengkapi informasi produk di bawah ini
                            </p>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('product.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                                Nama Produk
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
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
                                       value="{{ old('qty') }}"
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
                                       value="{{ old('price') }}"
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

                        {{-- Kategori --}}
                        <div>
                            <label for="kategori_id" class="block text-sm font-semibold text-gray-900 mb-2">
                                Kategori Produk
                            </label>
                            <select id="kategori_id" 
                                    name="kategori_id"
                                    class="block w-full px-4 py-2.5 border rounded-lg text-gray-900 text-sm appearance-none
                                    {{ $errors->has('kategori_id') ? 'border-red-500 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }}
                                    focus:outline-none focus:ring-1 focus:border-transparent transition"
                                    style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20fill=%22none%22%20viewBox=%220%200%2024%2024%22%20stroke=%22currentColor%22%3E%3Cpath%20stroke-linecap=%22round%22%20stroke-linejoin=%22round%22%20stroke-width=%222%22%20d=%22M19%209l-7%207-7-7%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em; padding-right: 2.5rem;">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 mt-8">
                            <a href="{{ route('product.index') }}"
                               class="px-6 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-6 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"">
                                 Simpan Produk
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
