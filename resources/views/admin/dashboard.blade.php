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
          <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-red-500 font-extrabold">
                <span class="typing">{{ __("Hi Admin, You're logged in!") }}</span>
              </div>
          </div>
      </div>
  </div>

  {{-- Card Pengambilan Inventaris --}}
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center lg:mb-6 mb-4">
          <p class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Inventaris Badan Kesbangpol Jateng</p>
      </div>
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <form method="GET" action="{{ route('admin.dashboard') }}"> <!-- Add form action for GET request -->
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
        
        <div class="mt-6 flow-root sm:mt-8">
          <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @php
              $groupedTransactions = $transactions->groupBy(function($item) {
                  return $item->submission_date . '-' . $item->email;
              });
            @endphp
            @foreach ($groupedTransactions as $key => $tr)
              <div class="flex flex-wrap items-center gap-y-4 gap-x-2 py-6">
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Bidang:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                    <a href="#" class="hover:underline">{{ $tr->first()->bidang->nama_bidang }}</a>
                  </dd>
                </dl>
    
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Pengajuan:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $tr->first()->submission_date }}</dd>
                </dl>
    
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Nama Staf:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $tr->first()->staff->nama }}</dd>
                </dl>
    
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                  <dd class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium
                      @if($tr->first()->status == 'Approved') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                      @elseif($tr->first()->status == 'Pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                      @elseif($tr->first()->status == 'Rejected') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                      @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300
                      @endif">
                      
                      @switch($tr->first()->status)
                          @case('Approved')
                              <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                              </svg>
                              @break
                          @case('Pending')
                            <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                            </svg>
                              @break
                          @case('Rejected')
                              <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12m0-12L6 18" />
                              </svg>
                              @break
                          @default
                              <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v20M2 12h20" />
                              </svg>
                      @endswitch
                      
                      {{ $tr->first()->status }}
                  </dd>
                </dl>
    
                <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4 accordion-header">
                    <button
                        id="approveButton-{{ $tr->first()->id }}"
                        data-id="{{ $tr->first()->id }}"
                        class="approve-btn w-full rounded-lg border px-3 py-2 text-center text-sm font-medium
                            {{ $tr->first()->status === 'Approved' ? 'text-white bg-red-500 border-red-700 hover:bg-red-700 approved' : 'text-white bg-green-500 border-green-700 hover:bg-green-700' }}">
                        {{ $tr->first()->status === 'Approved' ? 'Batalkan' : 'Setujui Pengajuan' }}
                    </button>

                  <span class="accordion-icon w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">Rincian</span>  
                </div>

                <div class="p-4 bg-white hidden">
                  @foreach ($tr as $transaction)
                      <div class="mb-4 p-4 border bg-gray-200 rounded-lg shadow-lg w-[1000px] mx-auto">
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
                          </div>            
                      </div>
                  @endforeach
              </div>
              </div>
            @endforeach  
          </div>
        </div>
      </div>     
    </div>

    <nav class="mt-6 flex items-center justify-center sm:mt-8 sm:mb-8" aria-label="Page navigation example">
        <ul class="flex h-8 items-center -space-x-px text-sm">
          <li>
            @if(request('bidang') || request('duration')) <!-- Memeriksa apakah ada filter yang dipilih -->
              <div class="flex justify-center mt-4"> <!-- Membungkus form dalam div dengan flexbox untuk memusatkan -->
                <form action="{{ route('admin.generate-pdf') }}" method="GET" class="text-center">
                    <input type="hidden" name="bidang" value="{{ request('bidang') }}">
                    <input type="hidden" name="duration" value="{{ request('duration') }}">
                    <button type="submit" class="bg-white text-black border-2 border-black rounded-lg px-4 py-2 hover:bg-gray-100">Download PDF</button>
                  </form>
              </div>
            @endif
          </li>
        </ul>
    </nav>

    {{-- Flash Message Popup --}}
      @if (session('success'))
        <div id="flash-success" class="fixed top-5 right-5 z-50">
            <div class="p-4 rounded-lg shadow-lg bg-green-500 text-white">
                <p>{{ session('success') }}</p>
            </div>
        </div>
      @endif

      @if (session('error'))
          <div id="flash-error" class="fixed top-5 right-5 z-50">
              <div class="p-4 rounded-lg shadow-lg bg-red-500 text-white">
                  <p>{{ session('error') }}</p>
              </div>
          </div>
      @endif

      <!-- Main modal -->
      <!-- Modal -->
    <div id="confirmModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black opacity-50" id="modalBackdrop"></div>
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative z-10">
            <h2 class="text-xl font-bold text-gray-800 mb-2" id="modalTitle">Konfirmasi</h2>
            <p class="text-gray-600 mb-4" id="modalMessage">Apakah Anda yakin ingin menyetujui pengajuan ini?</p>
            <div class="flex justify-end space-x-2">
                <button id="modalCancel" class="px-4 py-2 rounded bg-gray-500 text-white">Batal</button>
                <form id="modalForm" method="POST" action="">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded text-white" id="modalConfirmBtn">Setujui</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById('confirmModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalForm = document.getElementById('modalForm');
        const modalConfirmBtn = document.getElementById('modalConfirmBtn');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalCancel = document.getElementById('modalCancel');
    
        // Fungsi buka modal
        function openModal(action, id, button) {
            modal.classList.remove('hidden');
    
            if (action === 'approve') {
                modalTitle.textContent = 'Konfirmasi Persetujuan';
                modalMessage.textContent = 'Apakah Anda yakin ingin menyetujui pengajuan ini?';
                modalConfirmBtn.textContent = 'Setujui';
                modalConfirmBtn.className = 'px-4 py-2 rounded text-white bg-green-600';
                modalForm.action = `/admin/approve/${id}`;
            } else {
                modalTitle.textContent = 'Konfirmasi Pembatalan';
                modalMessage.textContent = 'Apakah Anda yakin ingin membatalkan persetujuan?';
                modalConfirmBtn.textContent = 'Batalkan';
                modalConfirmBtn.className = 'px-4 py-2 rounded text-white bg-red-600';
                modalForm.action = `/admin/pending/${id}`;
            }
    
            // Simpan referensi tombol agar bisa diubah teks/kelasnya setelah submit
            modalForm.dataset.targetBtnId = button.id;
            modalForm.dataset.actionType = action;
        }
    
        // Tutup modal
        modalCancel.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    
        // Klik backdrop juga menutup modal
        modalBackdrop.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    
        // Handle semua tombol approve-btn
        document.querySelectorAll('.approve-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const isApproved = this.classList.contains('approved');
                const action = isApproved ? 'cancel' : 'approve';
                openModal(action, id, this);
            });
        });

        document.querySelectorAll(".accordion-header").forEach(header => {
            header.addEventListener("click", function () {
                let content = this.nextElementSibling;
                content.classList.toggle("hidden");
                let icon = this.querySelector(".accordion-icon");
                icon.textContent = content.classList.contains("hidden") ? "Rincian" : "Tutup";
            });
        }); 
    
        // Simulasi submit form
        modalForm.addEventListener('submit', function (e) {
            e.preventDefault(); // remove this if you want real form submit
    
            const btnId = this.dataset.targetBtnId;
            const action = this.dataset.actionType;
            const btn = document.getElementById(btnId);
    
            if (action === 'approve') {
                btn.textContent = 'Batalkan';
                btn.classList.remove('text-green-700', 'border-green-700', 'hover:bg-green-700');
                btn.classList.add('text-red-700', 'border-red-700', 'hover:bg-red-700', 'approved');
            } else {
                btn.textContent = 'Setujui Pengajuan';
                btn.classList.remove('text-red-700', 'border-red-700', 'hover:bg-red-700', 'approved');
                btn.classList.add('text-green-700', 'border-green-700', 'hover:bg-green-700');
            }
    
            modal.classList.add('hidden');
            this.submit(); // Uncomment this if you want to do real submission
        });
        setTimeout(() => {
            const successFlash = document.getElementById('flash-success');
            const errorFlash = document.getElementById('flash-error');

            if (successFlash) successFlash.classList.add('hidden');
            if (errorFlash) errorFlash.classList.add('hidden');
        }, 1000); // 3 detik
    });
</script>
    
    
    
