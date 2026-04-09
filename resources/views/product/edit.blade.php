<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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
                            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Edit Product</h2>
                            <p class="text-sm text-gray-600 mt-0.5">
                                Update details for <span class="font-medium text-gray-700">{{ $product->name }}</span>
                            </p>
                        </div>
                    </div>

                    <form id="delete-product-form" action="{{ route('product.delete', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>

                    {{-- Form --}}
                    <form action="{{ route('product.update', $product) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div>
                            <label for="name"
                                   class="block text-sm font-medium text-gray-700 mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name', $product->name) }}" placeholder="e.g. Wireless Headphones"
                                   class="w-full px-4 py-2.5 rounded-lg border text-sm
                                   {{ $errors->has('name') ? 'border-red-500 bg-red-50' : 'border-gray-300 bg-white' }}
                                   text-gray-900 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Quantity & Price --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="qty"
                                       class="block text-sm font-medium text-gray-700 mb-1">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="qty" name="qty"
                                       value="{{ old('qty', $product->qty) }}" placeholder="0" min="0"
                                       class="w-full px-4 py-2.5 rounded-lg border text-sm
                                       {{ $errors->has('qty') ? 'border-red-500 bg-red-50' : 'border-gray-300 bg-white' }}
                                       text-gray-900 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition">
                                @error('qty')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price"
                                       class="block text-sm font-medium text-gray-700 mb-1">
                                    Price (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="price" name="price"
                                       value="{{ old('price', $product->price) }}" placeholder="0" min="0"
                                       step="0.01"
                                       class="w-full px-4 py-2.5 rounded-lg border text-sm
                                       {{ $errors->has('price') ? 'border-red-500 bg-red-50' : 'border-gray-300 bg-white' }}
                                       text-gray-900 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition">
                                @error('price')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- User --}}
                        <div>
                            <label for="user_id"
                                   class="block text-sm font-medium text-gray-700 mb-1">
                                Owner <span class="text-red-500">*</span>
                            </label>
                            <select id="user_id" name="user_id"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('user_id') ? 'border-red-500 bg-red-50' : 'border-gray-300 bg-white' }}
                                    text-gray-900
                                    focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition">
                                <option value="">-- Select Owner --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                            {{ (old('user_id', $product->user_id) == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('product.index') }}"
                               class="px-4 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="px-6 py-2.5 bg-gray-800 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                                Update Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>