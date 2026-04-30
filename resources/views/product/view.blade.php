<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('product.index') }}"
                               class="p-1.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Product</h2>
                                <p class="text-sm text-gray-600 mt-0.5">Viewing product
                                    #{{ $product->id }}</p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-2">
                            @can('update', $product)
                                <x-edit-product :url="route('product.edit', $product)" />
                            @endcan

                            @can('delete', $product)
                                <x-delete-product :url="route('product.delete', $product->id)" />
                            @endcan
                        </div>
                    </div>

                    {{-- Detail Card --}}
                    <div class="rounded-lg border border-gray-200 divide-y divide-gray-200">
                        
                        {{-- Name --}}
                        <div class="flex items-center px-6 py-4">
                            <div class="w-32 shrink-0 text-sm font-medium text-gray-700">Product Name</div>
                            <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                        </div>

                        {{-- Quantity --}}
                        <div class="flex items-center px-6 py-4">
                            <div class="w-32 shrink-0 text-sm font-medium text-gray-700">Quantity :</div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $product->qty > 10
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-red-100 text-red-800' }}">
                                    {{ $product->qty }} {{ $product->qty > 10 ? 'In Stock' : 'Low Stock' }}
                                </span>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="flex items-center px-6 py-4">
                            <div class="w-32 shrink-0 text-sm font-medium text-gray-700">Price : </div>
                            <div class="text-sm font-mono font-medium text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>

                        {{-- Owner --}}
                        <div class="flex items-center px-6 py-4">
                            <div class="w-32 shrink-0 text-sm font-medium text-gray-700">Owner :</div>
                            <div class="flex items-center gap-2">
                                <div class="h-7 w-7 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 text-xs font-bold uppercase">
                                    {{ substr($product->user->name ?? '?', 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-700">{{ $product->user->name ?? '-' }}</span>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="flex items-center px-6 py-4">
                            <div class="w-32 shrink-0 text-sm font-medium text-gray-700">Category :</div>
                            <div class="text-sm text-gray-700">
                                {{ $product->kategori->name ?? '-' }}
                            </div>
                        </div>

                        {{-- Created At --}}
                        <div class="flex items-center px-6 py-4">
                            <div class="w-32 shrink-0 text-sm font-medium text-gray-700">Created At</div>
                            <div class="text-sm text-gray-700">
                                {{ $product->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>

                        {{-- Updated At --}}
                        <div class="flex items-center px-6 py-4">
                            <div class="w-32 shrink-0 text-sm font-medium text-gray-700">Updated At</div>
                            <div class="text-sm text-gray-700">
                                {{ $product->updated_at->format('d M Y, H:i') }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>