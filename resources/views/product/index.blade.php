<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                                Product List
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Manage your product inventory
                            </p>
                        </div>

                        @can('manage-product')
                            <a href="{{ route('product.create') }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition duration-150 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 4v16m8-8H4" />
                                </svg>
                                Add Product
                            </a>
                        @endcan
                    </div>

                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-8">
                                        #
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Owner
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-gray-50 transition duration-100">
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 font-medium text-gray-800">
                                            {{ $product->name }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-700">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $product->qty > 10 
                                                    ? 'bg-green-100 text-green-800' 
                                                    : 'bg-red-100 text-red-800' }}">
                                                {{ $product->qty }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-gray-700 font-mono">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $product->user->name ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">

                                                {{-- View --}}
                                                <a href="{{ route('product.show', $product->id) }}"
                                                   class="p-1.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition"
                                                   title="View">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                                 c4.477 0 8.268 2.943 9.542 7
                                                                 -1.274 4.057-5.065 7-9.542 7
                                                                 -4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                {{-- Edit --}}
                                                @can('update', $product)
                                                    <a href="{{ route('product.edit', $product) }}"
                                                       class="p-1.5 rounded-md text-gray-500 hover:text-amber-600 hover:bg-amber-50 transition"
                                                       title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="h-4 w-4"
                                                             fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M11 5h2m-1-1v2m0 12h2m-1 1v-2m-6-6H5m1-1H4m12 0h2m-1-1v2M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                    </a>
                                                @endcan

                                                {{-- Delete --}}
                                                @can('delete', $product)
                                                    <form action="{{ route('product.delete', $product->id) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Delete this product?')"
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="p-1.5 rounded-md text-gray-500 hover:text-red-600 hover:bg-red-50 transition"
                                                                title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="h-4 w-4"
                                                                 fill="none"
                                                                 viewBox="0 0 24 24"
                                                                 stroke="currentColor">
                                                                <path stroke-linecap="round"
                                                                      stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                                     a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                                                                     M9 7h6m-1-3H10a1 1 0 00-1 1v2h6V5a1 1 0 00-1-1z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endcan

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            No products found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($products->hasPages())
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
