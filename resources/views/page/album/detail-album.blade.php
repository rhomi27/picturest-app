@extends('layout.master')
@section('content')
    @include('layout.navbar.nav1')
    @include('layout.bottom-nav')
    <section>
        <div class="container mx-auto p-5">
            <h1 class="text-lg font-semibold mb-4 sm:text-2xl">{{ $album->nama }}</h1>
            <div id="data-wrap"
                class="columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-6 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">

            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    var EndPoint = "{{ route('read.detail.album') }}";
        var page = 1;
        LoadMore(page); 

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                LoadMore(page);
            }
        });

        function LoadMore(page) {
            $.ajax({
                    url: EndPoint + "?page=" + page,
                    type: "get",
                    data: {
                        id: "{{ $album->id }}"
                    },
                    datatype: "html",
                    beforeSend: function() {
                        $('.loader').show();
                    }
                })
                .done(function(data) {
                    if (data.length == 0) {
                        $('.loader').html("tidak ada data lainnya");
                        return;
                    }
                    $('.loader').hide();
                    $("#data-wrap").append(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('server error');
                })
        }

</script>
@endsection
<!-- content -->
