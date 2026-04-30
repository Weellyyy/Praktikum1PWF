<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">
                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Back Button -->
                        <div class="flex items-center mb-8">
                            <a href="{{ route('kategori.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <h3 class="text-xl font-bold text-gray-900 ml-4">{{ __('Edit Category') }}</h3>
                        </div>

                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-3">
                                {{ __('Category') }}
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('name') border-red-500 @enderror transition" 
                                placeholder="e.g. Electronic"
                                value="{{ old('name', $kategori->name) }}"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 mt-8">
                            <a href="{{ route('kategori.index') }}" class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                                {{ __('Cancel') }}
                            </a>
                            <button 
                                type="submit" 
                                class="px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
                            >
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
