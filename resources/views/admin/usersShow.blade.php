@foreach ($user as $item)
    <div data-aos="fade-up"
        class="w-full bg-white border border-gray-200 rounded-lg pt-4 shadow dark:bg-gray-800 dark:border-gray-700 mb-4">
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 object-cover rounded-full shadow-lg"
                src="{{ asset('pictures/' . $item->pictures) }}" alt="{{ $item->username }}" />
            <h5 class="mb-1 text-base font-medium text-gray-900 dark:text-white">{{ $item->username }}</h5>
            <span class="text-xs text-gray-500 ">{{ $item->email }}</span>
            <span id="user-{{ $item->id }}" class="text-xs text-red-500 ">{{ $item->status }} </span>
            <div class="flex mt-4 md:mt-6 gap-3">
                <button data-user-id="{{ $item->id }}" data-nama="{{ $item->username }}"
                    data-status="{{ $item->status }}"
                    class="banned inline-flex items-center px-4 p-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">{{ $item->status == 'banned' ? 'Aktifkan user' : 'Banned user' }}</button>
                <a href="/users-info/{{ $item->id }}"
                    class="p-1 px-4 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 ">Info</a>
            </div>
        </div>
    </div>
@endforeach
