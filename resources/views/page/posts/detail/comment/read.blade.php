@foreach ($comen as $item)
    <div class="flex items-start gap-2 mb-2">
        <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('pictures/' . $item->users->pictures) }}"
            alt="Jese image" />
        <div class="gap-1 w-full">
            <div class="items-center space-x-2 rtl:space-x-reverse mb-2">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item->users->username }}</span>
                <span
                    class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
            </div>
            <div
                class="flex flex-row leading-1.5 p-2 border border-gray-300 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                <p class="text-sm font-normal text-gray-900 dark:text-white">
                    {{ $item->isi_komen }}
                </p>
            </div>
        </div>
    </div>
@endforeach
