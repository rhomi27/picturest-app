@extends('layout.master')
@section('content')
    @include('admin.layout.nav-side')
    <div class="p-4 sm:ml-64">
        <div class="container mx-auto p-5">
            <h1 class="text-lg font-semibold mb-4">Laporan dari Pengguna</h1>
            <div class="overflow-x-auto rounded-md shadow-md">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Pengirim</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Alasan Dilaporkan</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Postingan</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr id="report-{{ $item->id }}" class="border-b-2">
                                <td class="px-6 py-4 text-xs whitespace-nowrap">{{ $item->users->username }}</td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">{{ $item->alasan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"><img class="items-center h-16 w-16 object-contain"
                                        src="{{ asset('imagePost/' . $item->posts->file) }}" alt=""></td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">{{ $item->posts->status }}</td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    <a href="/detail-report/{{ $item->id }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-2">Cek</a>
                                    <button data-report-id="{{ $item->id }}"
                                        class="delete-btn text-red-600 hover:text-red-900">Hapus</button>
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
        $('.delete-btn').click(function() {
            const id = $(this).data('report-id')
            const delUrl = `/delete-report/${id}`
            Swal.fire({
                title: "kamu yakin?",
                text: `akan menghapus id ${id}`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: delUrl,
                        type: 'get',
                        success: function(res){
                            $(`#report-${id}`).hide('slow');
                        }
                    })
                    // Swal.fire({
                    //   title: "Deleted!",
                    //   text: "Your file has been deleted.",
                    //   icon: "success"
                    // });
                }
            });
        })
    </script>
@endsection
