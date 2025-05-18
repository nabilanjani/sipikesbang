<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat') }}
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

    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-6">
        
        <div class="mt-10 mx-auto max-w-screen-xl px-4 2xl:px-0">
            <form method="GET" action="{{ route('umpeg.riwayat') }}"> <!-- Add form action for GET request -->
                <div class="mx-auto max-w-5xl">
                    <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Pengajuan Inventaris</h2>
                        <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                            <div>
                                <label for="bidang" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select order type</label>
                                <select id="bidang" name="bidang" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                    <option value="">Pilih bidang</option>
                                    @foreach ($bidang as $bd)
                                        <option value="{{ $bd->id }}" {{ request('bidang') == $bd->id ? 'selected' : '' }}>{{ $bd->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
  
                            <span class="inline-block text-gray-500 dark:text-gray-400"> from </span>
  
                            <div>
                                <label for="duration" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select duration</label>
                                <select id="duration" name="duration" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                    <option value="this week" {{ request('duration') == 'this week' ? 'selected' : '' }}>this week</option>
                                    <option value="this month" {{ request('duration') == 'this month' ? 'selected' : '' }}>this month</option>
                                    <option value="last 3 months" {{ request('duration') == 'last 3 months' ? 'selected' : '' }}>the last 3 months</option>
                                    <option value="last 6 months" {{ request('duration') == 'last 6 months' ? 'selected' : '' }}>the last 6 months</option>
                                    <option value="this year" {{ request('duration') == 'this year' ? 'selected' : '' }}>this year</option>
                                </select>
                            </div>
                            <button type="submit" class="bg-red-500 text-white rounded-lg px-4 py-2">Filter</button>
                        </div>
                    </div>
              </div>
            </form>

              @php
                  $groupedTransactions = $transactions->groupBy(function($item) {
                      return $item->submission_date . '-' . $item->email;
                  });
              @endphp
              

            <div class="mt-6 flow-root sm:mt-8">
                <div class="divide-y divide-gray-200 dark:divide-red-500">
                    @foreach ($groupedTransactions as $key => $tr)
                        <div class="bg-red-200 rounded-lg mb-4 shadow-lg">
                            <div class="flex justify-between items-center p-4 cursor-pointer accordion-header">
                                <span class="text-gray-800 font-semibold">
                                    {{ $tr->first()->status }} - 
                                
                                    @if(isset($tr[0]->bidang))
                                        {{ $tr[0]->bidang->nama_bidang }}
                                    @endif
                                </span>
                                <span class="text-gray-800 font-bold accordion-icon">+</span>
                            </div>
            
                            <div class="p-4 bg-white hidden">
                                @foreach ($tr as $transaction)
                                    <div class="mb-4 p-4 border rounded-lg shadow-lg">
                                        <div class="flex flex-wrap items-center gap-y-2">
                                            <dl class="w-full sm:w-1/3 lg:w-1/4 px-1 mb-0">
                                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Pengajuan:</dt>
                                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                                    {{ $transaction->submission_date }}
                                                </dd>
                                            </dl>
            
                                            <dl class="w-full sm:w-1/3 lg:w-1/4 px-1 mb-0">
                                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Nama Staf:</dt>
                                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                                    {{ $transaction->staff->nama }}
                                                </dd>
                                            </dl>
                                            <dl class="w-full sm:w-1/3 lg:w-1/4 px-1 mb-0">
                                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Item:</dt>
                                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                                    {{ $transaction->item->name }} ({{ $transaction->quantity }})
                                                </dd>
                                            </dl>
                                            <!-- Tombol Delete -->
                                            <div class="w-full sm:w-1/4 lg:w-1/4 px-1 mb-0">
                                                <button type="button" 
                                                    class="delete-btn text-red-500 hover:text-red-700 w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-id="{{ $transaction->id }}" data-name="{{ $transaction->item->name }}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>            
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if (session('success'))
                <div id="flash-message" class="fixed top-5 right-5 z-50">
                    <div class="p-4 rounded-lg shadow-lg bg-green-500 text-white">
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
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

        
              <nav class="mt-6 flex items-center justify-center sm:mt-8 sm:mb-8" aria-label="Page navigation example">
                <ul class="flex h-8 items-center -space-x-px text-sm">
                  
                </ul>
              </nav>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".accordion-header").forEach(header => {
            header.addEventListener("click", function () {
                let content = this.nextElementSibling;
                content.classList.toggle("hidden");
                let icon = this.querySelector(".accordion-icon");
                icon.textContent = content.classList.contains("hidden") ? "+" : "-";
            });
        });


        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-id');
                const itemName = this.getAttribute('data-name');

                // Menampilkan nama item di modal
                document.getElementById('item-name').textContent = itemName;

                // Menetapkan form action untuk penghapusan item
                document.getElementById('deleteForm').action = '/umpeg/riwayat/' + itemId;

                // Menampilkan modal
                document.getElementById('deleteModal').classList.remove('hidden');
            });
        });

        // Menangani klik tombol Batal di modal
        document.getElementById('cancelDelete').addEventListener('click', function () {
            document.getElementById('deleteModal').classList.add('hidden');
        });

        const flashMessage = document.getElementById('flash-message');
    
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.display = 'none'; // Menghilangkan flash message setelah 3 detik
            }, 3000); // Waktu 3 detik (3000 ms)
        }
    });
</script>
