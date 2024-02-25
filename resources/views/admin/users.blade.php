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
                                Status</th>
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
                                <td id="user-{{ $item->id }}" class="px-6 py-4 text-xs whitespace-nowrap">
                                    {{ $item->status }}</td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    <a class="bg-indigo-400 p-1 text-white font-semibold hover:bg-indigo-600 rounded-lg px-2"
                                        href="/users-info/{{ $item->id }}">Cek</a>
                                    <button type="button" data-user-id="{{ $item->id }}"
                                        data-status="{{ $item->status }}" data-nama="{{ $item->username }}"
                                        class="banned px-5 px-4 p-1 bg-blue-500 text-white rounded shadow-md scale-100 hover:scale-105 hover:bg-blue-400">
                                        {{ $item->status === 'aktif' ? 'Banned user' : 'Aktifkan user' }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function showMessage(type, message) {
            Swal.fire({
                title: "Berhasil",
                text: message,
                icon: type
            });
        }
        $(document).ready(function() {
            $('.banned').click(function() {
                var userId = $(this).data('user-id');
                var status = $(this).data('status');
                var nama = $(this).data('nama');
                var button = $(this);
                Swal.fire({
                    title: "kamu yakin?",
                    text: `akan melakukan tindakan pada user ${nama}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Lakukan!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/banned-user/' + userId,
                            type: 'post',
                            data: {
                                status: status
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(response)
                                if (response.status == 400) {
                                    button.text('Aktifkan user');
                                    $(`#user-${userId}`).text('banned');
                                    showMessage('success', response.message)
                                } else if (response.status == 200) {
                                    button.text('Banned user');
                                    $(`#user-${userId}`).text('aktif');
                                    showMessage('success', response.message)
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection
