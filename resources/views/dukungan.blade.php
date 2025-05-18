<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dukungan Masyarakat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8 mt-12">
            <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Survey Kepuasan Masyarakat</h2>
            <h3 class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Layanan Publik Badan Kesatuan Bangsa dan Politik</h3>
            <h3 class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Provinsi Jawa Tengah Tahun 2024</h3>
        </div>
        <div class="container mx-auto p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                <div>
                    <div 
                        class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center cursor-pointer hover:bg-pink-300" 
                        onclick="window.open('https://eskm.jatengprov.go.id/skm/1243', '_blank')">
                        <i class="fas fa-laptop fa-3x text-gray-400 mb-4"></i>
                        <span class="text-black font-semibold">Layanan Data dan Informasi</span>
                    </div>
                </div>
                <div>
                    <div 
                        class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center cursor-pointer hover:bg-pink-300" 
                        onclick="window.open('https://eskm.jatengprov.go.id/skm/1244', '_blank')">
                        <i class="fas fa-users fa-3x text-gray-400 mb-4"></i>
                        <span class="text-black font-semibold">Layanan Keberadaan Ormas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
