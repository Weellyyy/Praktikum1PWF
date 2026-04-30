<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-6 flex justify-between items-start">
                <div>
                    <h2 class="font-semibold text-3xl text-gray-900">
                        {{ __('Category List') }}
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">{{ __('Manage your category') }}</p>
                </div>
                <a href="{{ route('kategori.create') }}" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold py-3 px-6 rounded-lg flex items-center gap-2 transition shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>{{ __('Add Category') }}</span>
                </a>
            </div>

            @if ($message = Session::get('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg animate-fade">
                    {{ $message }}
                </div>
            @endif

            @if (count($kategoris) > 0)
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-300">
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">{{ __('No') }}</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">{{ __('Name') }}</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">{{ __('Total Product') }}</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($kategoris as $key => $kategori)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $kategori->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                                {{ $kategori->products_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-blue-600 hover:text-blue-900 transition" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/>
                                        <path d="M20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                                </a>
                                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-9l-1 1H5v2h14V4z"/>
                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-gray-600 text-lg font-medium">{{ __('No category found') }}</p>
                    <p class="text-gray-500 text-sm mt-2">{{ __('Click the button above to create a new category') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
