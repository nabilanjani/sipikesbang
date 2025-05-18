<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola') }}
        </h2>
    </x-slot>

    
    <header class="bg-white shadow">
        <div class="flex justify-center h-16">
            <div class="flex space-x-8">
                <!-- Navigation Links -->
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Beranda') }}
                </x-nav-link>
                
                <x-nav-link :href="route('admin.kelola')" :active="request()->routeIs('admin.kelola')">
                    {{ __('Kelola') }}
                </x-nav-link>
            </div>
        </div>
    </header>
  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex justify-center">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                    Kelola Inventaris Badan Kesatuan Bangsa dan Politik
                </h2>
            </div>
        </div>
    </div>

    {{-- List Inventaris --}}
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12 mb-10">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center" method="GET" action="{{ route('admin.kelola.search') }}">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 
                                    4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   id="simple-search"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                   placeholder="Cari nama inventaris..." >
                        </div>
                    </form>                    
                </div>
                
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="flex items-center justify-center text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Inventaris
                    </button>
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filter
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                        <!-- Dropdown Filter Kategori -->
                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose category</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                <li class="flex items-center">
                                    <form action="{{ route('admin.kelola') }}" method="GET">
                                        @csrf
                                        <select id="categoryFilter" name="category_id" class="w-full p-2 border rounded-lg bg-white dark:bg-gray-800">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($categories as $ctg)
                                                <option value="{{ $ctg->id }}" {{ request('category_id') == $ctg->id ? 'selected' : '' }}>{{ $ctg->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="mt-2 w-full bg-red-700 text-white rounded py-2">Filter</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama produk</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Stock</th>
                            <th scope="col" class="px-4 py-3">Tanggal Pengadaan</th>
                            <th scope="col" class="px-4 py-3">Harga</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->name }}</th>
                                <td class="px-4 py-3">{{ $item->category->name ?? 'Tidak ada kategori' }}</td>
                                <td class="px-4 py-3">{{ $item->quantity }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->procurement_date)->format('d M Y') }}</td>
                                <td class="px-4 py-3">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 flex items-center justify-end relative">
                                    <!-- Tombol Dropdown -->
                                    <button id="dropdown-button-{{ $item->id }}" 
                                        class="dropdown-button inline-flex items-center p-0.5 text-sm font-medium text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" 
                                        type="button"
                                        onclick="toggleDropdown({{ $item->id }})">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        </svg>
                                    </button>
                                
                                    <!-- Dropdown -->
                                    <div id="dropdown-{{ $item->id }}" class="dropdown-menu hidden absolute right-0 mt-2 w-44 bg-white rounded shadow divide-y divide-gray-100 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                            <li>
                                                <button type="button" 
                                                    class="edit-button block w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-item='@json($item)'>
                                                    Edit
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <button type="button" 
                                                class="delete-btn text-red-500 hover:text-red-700 w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>                       
                            </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-3">Tidak ada data ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>  

    {{-- Flash Message Popup --}}
    @if (session('success'))
        <div id="flashMessageSuccess" class="fixed top-5 right-5 z-50">
            <div class="p-4 rounded-lg shadow-lg bg-green-500 text-white">
                <p>{{ session('success') }}</p>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const flashMessage = document.getElementById('flashMessageSuccess');
                if (flashMessage) {
                    flashMessage.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif

    @if (session('error'))
        <div id="flashMessageError" class="fixed top-5 right-5 z-50">
            <div class="p-4 rounded-lg shadow-lg bg-red-500 text-white">
                <p>{{ session('error') }}</p>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const flashMessage = document.getElementById('flashMessageError');
                if (flashMessage) {
                    flashMessage.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="bg-black opacity-50 absolute inset-0"></div>
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-4 relative">
            <h3 class="text-xl font-semibold text-gray-900">Konfirmasi Hapus</h3>
            <p class="mt-2 text-gray-600">Apakah Anda yakin ingin menghapus item <span id="item-name"></span>?</p>
            <div class="mt-4 flex justify-between">
                <button id="cancelDelete" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <form id="deleteForm" method="POST" action="" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Inventaris --}}
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Inventaris
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                
                <!-- Modal body -->
                <form action="{{ route('admin.kelola.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Masukkan nama produk" required="">
                        </div>
                        <div>
                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock Satuan</label>
                            <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="100" required="">
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga per pcs</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Contoh: 10.000" required="">
                        </div>
                        <div>
                            <label for="procurement_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Tanggal Pengadaan
                            </label>
                            <input 
                                type="date" 
                                name="procurement_date" 
                                id="procurement_date" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" 
                                required>
                        </div>                        
                        <div>
                            <label for="condition" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kondisi</label>
                            <input type="text" name="condition" id="condition" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Baik / Rusak / Hilang" required="">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                <option selected disabled>Pilih Kategori</option>
                                @foreach ($categories as $ctg)
                                    <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Masukkan detail produk seperti kontak pemasok dsb."></textarea>                    
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-red-700 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    <div id="editModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 flex items-center justify-center z-50 w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Inventaris
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="editModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form id="editForm" method="POST" action="#">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <input type="hidden" name="id" id="edit-id">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="edit-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                required>
                        </div>
                        <div>
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock Satuan</label>
                            <input type="text" name="quantity" id="edit-quantity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                required>
                        </div>
                        <div>
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga per pcs</label>
                            <input type="number" name="price" id="edit-price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                required>
                        </div>
                        <div>
                            <label for="procurement_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Pengadaan</label>
                            <input type="date" name="procurement_date" id="edit-procurement_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                required>
                        </div>
                        <div>
                            <label for="condition"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kondisi</label>
                            <input type="text" name="condition" id="edit-condition"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                required>
                        </div>
                        <div>
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select id="edit-category" name="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                <option selected disabled>Pilih Kategori</option>
                                @foreach ($categories as $ctg)
                                    <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea id="edit-description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-red-700 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-button").forEach(button => {
            button.addEventListener("click", function () {
                let item = JSON.parse(this.getAttribute("data-item"));
                let form = document.getElementById("editForm");

                if (item.id) {
                    form.action = "/admin/kelola/" + item.id;
                } else {
                    console.error("ID item tidak ditemukan!");
                }

                document.getElementById("edit-name").value = item.name;
                document.getElementById("edit-quantity").value = item.quantity;
                document.getElementById("edit-price").value = item.price;
                document.getElementById("edit-procurement_date").value = item.procurement_date;
                document.getElementById("edit-condition").value = item.condition;
                document.getElementById("edit-category").value = item.category_id;
                document.getElementById("edit-description").value = item.description;
                document.getElementById("editModal").classList.remove("hidden");
            });
        });

        // ✅ Perbaikan Dropdown
        window.toggleDropdown = function (id) {
            let dropdown = document.getElementById(`dropdown-${id}`);

            if (!dropdown) {
                console.error(`Dropdown dengan ID 'dropdown-${id}' tidak ditemukan.`);
                return;
            }

            // Tutup semua dropdown kecuali yang diklik
            document.querySelectorAll(".dropdown-menu").forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.add("hidden");
                }
            });

            // ✅ Gunakan setTimeout agar klik tombol di dalam dropdown tetap bisa bekerja
            setTimeout(() => {
                dropdown.classList.toggle("hidden");
            }, 100);
        };

        // ✅ Menutup dropdown hanya jika klik di luar semua dropdown
        document.addEventListener("click", function (event) {
            let isDropdownButton = event.target.closest(".dropdown-button");
            let isDropdownMenu = event.target.closest(".dropdown-menu");

            if (!isDropdownButton && !isDropdownMenu) {
                document.querySelectorAll(".dropdown-menu").forEach(dropdown => {
                    dropdown.classList.add("hidden");
                });
            }
        });

        // ✅ Menutup modal edit jika tombol close diklik
        document.querySelectorAll("[data-modal-toggle='editModal']").forEach(button => {
            button.addEventListener("click", function () {
                document.getElementById("editModal").classList.add("hidden");
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-id');
                const itemName = this.getAttribute('data-name');

                // Menampilkan nama item di modal
                document.getElementById('item-name').textContent = itemName;

                // Menetapkan form action untuk penghapusan item
                document.getElementById('deleteForm').action = '/admin/kelola/' + itemId;

                // Menampilkan modal
                document.getElementById('deleteModal').classList.remove('hidden');
            });
        });

        // Menangani klik tombol Batal di modal
        document.getElementById('cancelDelete').addEventListener('click', function () {
            document.getElementById('deleteModal').classList.add('hidden');
        });
    });

</script>