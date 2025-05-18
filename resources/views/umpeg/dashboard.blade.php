<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <header class="bg-white shadow">
        <div class="flex justify-center h-16">
            <div class="flex space-x-8">
                <!-- Navigation Links -->
                <x-nav-link :href="route('umpeg.dashboard')" :active="request()->routeIs('umpeg.dashboard')">
                    {{ __('Beranda') }}
                </x-nav-link>
                
                <x-nav-link :href="route('umpeg.riwayat')" :active="request()->routeIs('umpeg.riwayat')">
                    {{ __('Riwayat') }}
                </x-nav-link>
            </div>
        </div>
    </header>  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-red-500 font-extrabold">
                    <span class="typing">{{ __("Hi Umum dan Kepegawaian, You're logged in!") }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-screen-sm text-center lg:mb-6 mb-4">
            <p class="mb-8 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Inventaris Badan Kesbangpol Jateng</p>
        </div>
        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="flex items-center mb-4" method="GET" action="{{ route('umpeg.dashboard.search') }}">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 
                            4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="simple-search" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                        placeholder="Cari nama inventaris">
                </div>
            </form>            
        </div>

        <div class="mx-auto mt-8 max-w-screen-xl px-4 lg:flex lg:items-start lg:gap-8">
            <div class="w-full lg:w-2/3 xl:w-3/4">
                <div class="space-y-6">
                    @forelse ($items as $item)
                        <div class="item-card rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6 data-name="{{ strtolower($item->name) }}">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                <a href="#" class="shrink-0 md:order-1">
                                    <img class="h-20 w-20 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="{{ $item->name }}" />
                                    <img class="hidden h-20 w-20 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="{{ $item->name }}" />
                                </a>
        
                                <label for="counter-input-{{ $item->id }}" class="sr-only">Choose quantity:</label>
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                    <div class="flex items-center">
                                        <!-- Tombol Kurangi -->
                                        <button type="button" id="decrement-button-{{ $item->id }}" class="counter-btn inline-flex h-6 w-6 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none disabled:opacity-50" disabled>
                                            <svg class="h-3 w-3 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
        
                                        <!-- Input Quantity -->
                                        <input type="text" id="counter-input-{{ $item->id }}" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 dark:text-white" value="0" readonly />
        
                                        <!-- Tombol Tambah -->
                                        <button type="button" id="increment-button-{{ $item->id }}" class="counter-btn inline-flex h-6 w-6 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none">
                                            <svg class="h-3 w-3 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
        
                                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                    <p class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $item->name }} - (Kategori: {{ $item->category->name ?? 'Tidak ada kategori' }})
                                    </p>
        
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Kondisi: {{ ucfirst($item->condition) }} | Stock: {{ $item->quantity }}
                                    </p>
        
                                    <div class="flex items-center gap-4">
                                        <button type="button" class="add-to-cart-btn inline-flex items-center text-sm font-medium text-blue-600 hover:underline dark:text-blue-400" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                            <svg class="me-1.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/>
                                            </svg>
                                            Tambahkan ke Keranjang
                                        </button>
                                        <button type="button" class="remove-btn inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                            <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                            Batalkan
                                        </button>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada inventaris yang tersedia.</p>
                    @endforelse
                </div>
            </div>

            <div class="w-full lg:w-1/3 xl:w-1/4">
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Daftar Inventaris</p>
            
                    <div id="order-summary" class="space-y-4">
                        <div class="space-y-2" id="order-items">
                            <p class="text-gray-500 dark:text-gray-400">Tidak ada item.</p>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-600">
                        <p class="text-lg font-medium text-gray-900 dark:text-white">
                            Total: <span id="total-items" class="font-bold">0</span> item
                        </p>
                    </div>
            
                    <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="mt-4 flex w-full items-center justify-center rounded-lg bg-red-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                        Buat Pengajuan
                    </button>
                </div>
            </div>
            
        </div>    
        
        @if (session('success'))
            <div id="flash-message" class="fixed top-5 right-5 z-50">
                <div class="p-4 rounded-lg shadow-lg bg-green-500 text-white">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif


        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4 sm:mt-8 sm:mb-8" aria-label="Table navigation">
            
        </nav>
    </div>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Pengajuan
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('umpeg.dashboard.pengajuan') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <input type="hidden" name="items" id="items-input"> <!-- Input untuk menyimpan items -->
                        <input type="hidden" name="status" value="pending">
                        <div>
                            <label for="bidang_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bidang</label>
                            <select id="bidang_id" name="bidang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Pilih bidang</option>
                                @foreach ($bidang as $bd)
                                    <option value="{{ $bd->id }}">{{ $bd->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="staff_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <select id="staff_id" name="staf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Nama Staf</option>
                                @foreach ($staf as $stf)
                                    <option value="{{ $stf->id }}">{{ $stf->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan email staf" required="">
                        </div>
                        <div>
                            <label for="submission_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Tanggal Pengajuan
                            </label>
                            <input 
                                type="date" 
                                name="submission_date" 
                                id="submission_date" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>                    
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Tambah Pengajuan
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let cartItems = JSON.parse(sessionStorage.getItem("cart")) || [];

        // ✅ Event Listener untuk Counter Button
        document.querySelectorAll(".counter-btn").forEach(button => {
            button.addEventListener("click", function () {
                let itemId = this.id.split("-")[2];
                let input = document.getElementById(`counter-input-${itemId}`);
                let decrementBtn = document.getElementById(`decrement-button-${itemId}`);

                if (!input) {
                    console.error(`Element #counter-input-${itemId} tidak ditemukan!`);
                    return;
                }

                let value = parseInt(input.value);

                if (this.id.includes("increment")) {
                    input.value = value + 1;
                    decrementBtn.removeAttribute("disabled"); // Aktifkan tombol -
                } else if (this.id.includes("decrement") && value > 0) {
                    input.value = value - 1;
                    if (parseInt(input.value) === 0) {
                        decrementBtn.setAttribute("disabled", "true"); // Nonaktifkan tombol - jika 0
                    }
                }
            });
        });

        // ✅ Event Listener untuk Add to Cart
        document.querySelectorAll(".add-to-cart-btn").forEach(button => {
            button.addEventListener("click", function () {
                let itemId = this.dataset.id;
                let itemName = this.dataset.name;
                let counterInput = document.querySelector(`#counter-input-${itemId}`);
                let quantity = parseInt(counterInput.value);

                console.log("Menambahkan item:", itemName, "dengan ID:", itemId); // Debugging

                if (quantity > 0) {
                    let existingItem = cartItems.find(item => item.id === itemId);
                    if (existingItem) {
                        existingItem.quantity += quantity;
                    } else {
                        cartItems.push({ id: itemId, name: itemName, quantity: quantity });
                    }

                    sessionStorage.setItem("cart", JSON.stringify(cartItems));
                    updateOrderSummary();
                } else {
                    alert("Pilih jumlah item terlebih dahulu!");
                }
            });
        });

        // ✅ Fungsi Hapus Item dari Keranjang
        function removeItemFromCart(itemId) {
            cartItems = cartItems.filter(item => item.id !== itemId);
            sessionStorage.setItem("cart", JSON.stringify(cartItems));
            updateOrderSummary();
        }

        // ✅ Event Listener untuk Tombol Remove
        document.querySelectorAll(".remove-btn").forEach(button => {
            button.addEventListener("click", function () {
                let itemId = this.previousElementSibling.getAttribute("data-id");
                removeItemFromCart(itemId);
            });
        });
        

        // ✅ Fungsi Update Order Summary
        function updateOrderSummary() {
            let orderItemsContainer = document.getElementById("order-items");
            let totalItemsElement = document.getElementById("total-items");
            let cartDataInput = document.getElementById("items-input");

            orderItemsContainer.innerHTML = '';

            if (cartItems.length === 0) {
                orderItemsContainer.innerHTML = '<p class="text-gray-500 dark:text-gray-400">Tidak ada item di keranjang.</p>';
                totalItemsElement.innerText = "0";
                cartDataInput.value = "";
                return;
            }

            let totalQuantity = 0;
            cartItems.forEach((item, index) => {
                let itemElement = document.createElement("div");
                itemElement.classList.add("flex", "justify-between", "items-center", "text-gray-900", "dark:text-white");
                
                itemElement.innerHTML = `
                    <span>${item.name} x${item.quantity}</span>
                    <button class="delete-btn text-red-600 hover:underline dark:text-red-500" data-index="${index}">Delete</button>
                `;
                orderItemsContainer.appendChild(itemElement);

                totalQuantity += item.quantity;
            });

            totalItemsElement.innerText = totalQuantity;
            
            // ✅ Simpan items dalam format JSON yang valid
            cartDataInput.value = JSON.stringify(cartItems);
        }

         // Event listener untuk tombol 'Delete' di order summary
        document.getElementById("order-items").addEventListener("click", function (event) {
            if (event.target.classList.contains("delete-btn")) {
                let index = event.target.dataset.index;
                if (cartItems[index].quantity > 1) {
                    cartItems[index].quantity -= 1;
                } else {
                    cartItems.splice(index, 1);
                }
                sessionStorage.setItem("cart", JSON.stringify(cartItems));
                updateOrderSummary();
            }
        });

        // ✅ Pastikan Data Cart Ditampilkan di Modal Saat Checkout
        document.getElementById('defaultModalButton').addEventListener('click', function () {
            document.getElementById('items-input').value = JSON.stringify(cartItems);
        });

        // ✅ Event Listener untuk Dropdown Bidang & Staf
        const bidangSelect = document.getElementById("bidang_id");
        const staffSelect = document.getElementById("staff_id");
        const emailInput = document.getElementById("email");

        const stafData = @json($staf);

        bidangSelect.addEventListener("change", function () {
            const bidangId = bidangSelect.value;
            staffSelect.innerHTML = '<option selected value="">Nama Staf</option>';

            if (bidangId) {
                const filteredStaf = stafData.filter(staf => staf.bidang_id == bidangId);

                filteredStaf.forEach(staf => {
                    const option = document.createElement("option");
                    option.value = staf.id;
                    option.textContent = staf.nama;
                    option.dataset.email = staf.email;
                    staffSelect.appendChild(option);
                });
            }
        });

        staffSelect.addEventListener("change", function () {
            const selectedOption = staffSelect.options[staffSelect.selectedIndex];
            emailInput.value = selectedOption.dataset.email || "";
        });

        // ✅ Load Data Cart Saat Halaman Dimuat
        sessionStorage.removeItem('cart');
        updateOrderSummary();

        const flashMessage = document.getElementById('flash-message');
    
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.display = 'none'; // Menghilangkan flash message setelah 3 detik
            }, 3000); // Waktu 3 detik (3000 ms)
        }

        // 🔍 Filter item berdasarkan pencarian
        const searchInput = document.getElementById('simple-search');
        const itemCards = document.querySelectorAll('.item-card');

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();

            itemCards.forEach(card => {
                const itemName = card.dataset.name;

                if (itemName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

</script>
    
