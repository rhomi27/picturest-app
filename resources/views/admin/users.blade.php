@extends('layout.master')
@section('content')
    @include('admin.layout.nav-side')
    <div class="p-4 sm:ml-64">
        <div class="container mx-auto p-5">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                info</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($user as $item)
                        <tr>
                            <td class="px-6 py-4 text-xs whitespace-nowrap">{{ $item->username }}</td>
                            <td class="px-6 py-4 text-xs whitespace-nowrap">{{ $item->email }}</td>
                            <td class="px-6 py-4 text-xs whitespace-nowrap">
                                <a class="bg-indigo-400 p-1 text-white font-semibold hover:bg-indigo-600 rounded-lg px-2"
                                    href="/users-info/{{ $item->id }}">cek</a>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
