@extends('layout.master')
@section('content')
    @include('admin.layout.nav-side')
    <div class="p-4 sm:ml-64">
        <div id="navbar-search" class="sticky start-0 top-5 sm:top-5 w-full hidden sm:inline-block">
            <input id="search-report" type="text" class="p-1 rounded-md focus:outline-none px-4 text-sm w-full ">
        </div>
        <div class="container mx-auto p-5">
            <h1 class="text-lg font-semibold mb-4">Laporan dari Pengguna</h1>
            
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
                        success: function(res) {
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
