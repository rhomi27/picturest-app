@foreach ($data as $item)
<div class="p-3 px-5 sm:p-4 bg-white shadow-md mb-4">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full object-cover" src="{{ asset('pictures/'.$item->users->pictures) }}" alt="{{ $item-> }}">
        </div>
        <div class="flex-1 min-w-0 ms-4">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                Pelapor
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                pesan
            </p>
        </div>
        <div class="inline-flex flex-col gap-1 items-center text-base font-semibold text-gray-900 dark:text-white">
            <a class="text-xs border border-blue-600 px-3 bg-white hover:bg-blue-500 hover:text-white transition-all duration-1000" href="detail-report.html">lihat</a>
            <a class="text-xs border border-red-600 px-2 bg-white hover:bg-red-500 hover:text-white transition-all duration-1000" href="detail-report.html">hapus</a>
        </div>
    </div>
</div>
@endforeach