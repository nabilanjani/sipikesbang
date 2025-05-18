<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Inventaris') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mt-8 w-full flex justify-center">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                List Inventaris Badan Kesatuan Bangsa dan Politik
            </h2>
        </div>

        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('staf.dashboard') }}">
                <div class="relative overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between items-center px-6 py-4 space-x-1">
                        <!-- Filter berdasarkan nama -->
                        <div class="relative w-full max-w-md">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" placeholder="Search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>

                        <!-- Filter berdasarkan kategori -->
                        <div class="relative">
                            <select name="category" class="block w-full min-w-[12rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <table id="items-table" class="mt-8 min-w-full text-sm font-light border border-gray-300 border-collapse">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-left border-b border-gray-300">Nama</th>
                    <th class="px-6 py-4 text-left border-b border-gray-300">Kategori</th>
                    <th class="px-6 py-4 text-left border-b border-gray-300">Kondisi</th>
                    <th class="px-6 py-4 text-left border-b border-gray-300">Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $item->name }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $item->category->name ?? 'Tidak ada kategori' }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ ucfirst($item->condition) }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $item->quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada inventaris yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>        
    </div>
</x-app-layout>
