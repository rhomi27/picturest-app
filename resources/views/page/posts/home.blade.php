@extends('layout.master')
@section('content')
    @include('layout.navbar.nav1')
    @include('layout.bottom-nav')

    <div class="container mt-3 mx-auto">
        <div class="p-5 mb-28 mx-auto max-w-screen-xl">
            <div id="data-wrap"
                class="mb-5 columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-5 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">

            </div>
            <div class="loader flex justify-center items-center">
                <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var EndPoint = "{{ route('view.post') }}";
        var page = 1;
        LoadMore(page);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 5)) {
                page++;
                LoadMore(page);
            }
        });

        function LoadMore(page) {
            $.ajax({
                    url: EndPoint + "?page=" + page,
                    type: "get",
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

        function setInputValue() {
            const urlParams = new URLSearchParams(window.location.search);
            const tagValue = urlParams.get('tagValue');
            if (tagValue && tagValue.startsWith('#')) {
                // Menghilangkan karakter "#" dari nilai input
                tagValue = tagValue.substring(1);
            }
            if (tagValue) {
                document.getElementById('search-nav').value = tagValue;
                $('#search-button').click()
            }
        }

        function handleSearch() {
            let search_string = $("#search-nav").val();
            $.ajax({
                url: "{{ route('search.image') }}",
                method: "get",
                data: {
                    search_string: search_string
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(res) {
                    $('#data-wrap').html(res);
                    $('.loader').html("tidak ada data lainnya");
                    if (res.status == 400) {
                        $('.loader').html(res.pesan);
                    }
                }

            })
        }

        $(document).ready(function() {
            setInputValue()
            handleSearch()
            $(document).on('keyup', function(e) {
                e.preventDefault();
                handleSearch()
            });
        })
    </script>
@endsection
