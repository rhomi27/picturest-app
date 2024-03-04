@extends('layout.master')
@section('content')
    @include('layout.navbar.nav2')
    <!-- Main modal -->
    @include('page.posts.detail.modal-report')
    <section id="foto">
        <div class="container mx-auto p-5 w-full md:w-3/4">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 mt-10">
                <div data-aos="fade-right" class="w-full max-h-[560px] bg-white drop-shadow-md rounded-md">
                    <img class="w-full h-full object-contain" src="{{ asset('imagePost/' . $data->file) }}" alt="gambar" />
                </div>
                <div>
                    <div data-aos="fade-left" class="w-full max-h-full border border-gray-300 bg-white shadow-md p-4">
                        <div class="flex justify-between items-center">
                            @if (auth()->check() && $data->users->id === auth()->id())
                                <!-- Jika pengguna yang sedang login adalah pemiliknya -->
                                <a href="/profil" class="flex items-center">
                                    <img class="w-10 h-10 rounded-full object-cover mr-4"
                                        src="{{ asset('pictures/' . $data->users->pictures) }}" alt="Neil image" />
                                    <div class="flex flex-col">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $data->users->username }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ $data->users->email }}
                                        </p>
                                    </div>
                                </a>
                            @else
                                <a class="flex items-center" href="/profil-user/{{ $data->users->id }}">
                                    <img class="w-10 h-10 rounded-full object-cover mr-4"
                                        src="{{ asset('pictures/' . $data->users->pictures) }}" alt="Neil image" />
                                    <div class="flex flex-col">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $data->users->username }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ $data->users->email }}
                                        </p>
                                    </div>
                                </a>
                            @endif
                            @if (auth()->check() && $data->user_id !== auth()->id())
                                <button class="scale-100 hover:scale-105" id="follow-btn"
                                    data-user-id="{{ $data->users->id }}"
                                    data-follow="{{ Auth::user()->following()->where('following_id', $data->users->id)->first() }}">
                                    <svg id="notfollow" class="w-8 h-8 p-2 text-white bg-red-500 rounded-md px-2 drop-shadow-lg"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
                                        <g>
                                            <path
                                                d="M490.667,234.667H448V192c0-11.782-9.551-21.333-21.333-21.333c-11.782,0-21.333,9.551-21.333,21.333v42.667h-42.667   c-11.782,0-21.333,9.551-21.333,21.333c0,11.782,9.551,21.333,21.333,21.333h42.667V320c0,11.782,9.551,21.333,21.333,21.333   c11.782,0,21.333-9.551,21.333-21.333v-42.667h42.667c11.782,0,21.333-9.551,21.333-21.333   C512,244.218,502.449,234.667,490.667,234.667z" />
                                            <circle cx="192" cy="128" r="128" />
                                            <path
                                                d="M192,298.667c-105.99,0.118-191.882,86.01-192,192C0,502.449,9.551,512,21.333,512h341.333   c11.782,0,21.333-9.551,21.333-21.333C383.882,384.677,297.99,298.784,192,298.667z" />
                                        </g>
                                    </svg>
                                    <span 
                                        class="">
                                        <svg id="followed" class="bg-gray-300 w-8 h-8 p-2 hidden rounded-lg text-black px-2 drop-shadow-lg " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        data-name="Layer 1">
                                        <path
                                            d="m24 12a1 1 0 0 1 -1 1h-6a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-15 0a6 6 0 1 0 -6-6 6.006 6.006 0 0 0 6 6zm0 2a9.01 9.01 0 0 0 -9 9 1 1 0 0 0 1 1h16a1 1 0 0 0 1-1 9.01 9.01 0 0 0 -9-9z" />
                                    </svg>
                                    </span>
                                </button>
                            @endif
                        </div>
                        <div class="mt-4">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $data->judul }}
                            </h2>
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ $data->deskripsi }}
                            </p>
                            <p class="text-black dark:text-gray-300 mt-5">
                                @if (Str::startsWith($data->tag, '#'))
                                    Tag: <a href="/home?tagValue={{ substr($data->tag, 1) }}" id="tagLink"
                                        class="text-blue-600">{{ $data->tag }}</a>
                                @else
                                    Tag: <a href="/home?tagValue={{ $data->tag }}" id="tagLink"
                                        class="text-blue-600">{{ $data->tag }}</a>
                                @endif
                            </p>

                        </div>
                        <div class="flex justify-between mt-10">
                            <div class="flex items-center">
                                @if (auth()->check() && $data->user_id !== auth()->id())
                                    <svg data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                                        class="w-4 h-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                        data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                        <path
                                            d="M17,10c-3.86,0-7,3.14-7,7s3.14,7,7,7,7-3.14,7-7-3.14-7-7-7Zm0,12c-2.76,0-5-2.24-5-5s2.24-5,5-5,5,2.24,5,5-2.24,5-5,5Zm1.5-7.5c0,.83-.67,1.5-1.5,1.5s-1.5-.67-1.5-1.5,.67-1.5,1.5-1.5,1.5,.67,1.5,1.5Zm-.5,3.5v2c0,.55-.45,1-1,1s-1-.45-1-1v-2c0-.55,.45-1,1-1s1,.45,1,1Zm-9,3c0,.55-.45,1-1,1h-3c-2.76,0-5-2.24-5-5V5C0,2.24,2.24,0,5,0h5.76c1.05,0,2.08,.43,2.83,1.17l3.24,3.24c.67,.67,1.08,1.56,1.16,2.5,.04,.55-.37,1.03-.92,1.08-.03,0-.05,0-.08,0-.52,0-.95-.4-1-.92,0-.03,0-.05,0-.08h-2.98c-1.1,0-2-.9-2-2V2.02c-.08,0-.16-.02-.24-.02H5c-1.65,0-3,1.35-3,3v12c0,1.65,1.35,3,3,3h3c.55,0,1,.45,1,1Z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex items-center gap-x-5">
                                <button id="like-button" data-post-id="{{ $data->id }}"
                                    data-liked="{{ $data->likes->contains('user_id', auth()->id()) ? 'true' : 'false' }}"
                                    class="flex items-center gap-1">
                                    <svg id="like" fill="currentColor"
                                        class="h-5 w-5 scale-100 hover:scale-110 hover:drop-shadow-lg text-red-600 dark:text-gray-300 hover:text-blue-700 cursor-pointer scale-100 hover:scale-95"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z" />
                                    </svg>
                                    <svg id="liked" fill="currentColor"
                                        class="h-5 w-5 hidden scale-100 hover:scale-110 hover:drop-shadow-lg text-red-600 dark:text-gray-300 hover:text-blue-700 cursor-pointer scale-100 hover:scale-95"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z" />
                                    </svg>
                                    <span id="likeCount"
                                        class="text-gray-500 dark:text-gray-300">{{ $data->likes->count() }}</span>
                                </button>
                                <a href="#comment" class="flex items-center gap-1">
                                    <svg class="h-4 w-5" width="30" height="30" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="30" height="30" fill="url(#pattern0)" />
                                        <defs>
                                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                height="1">
                                                <use xlink:href="#image0_187_87" transform="scale(0.0078125)" />
                                            </pattern>
                                            <image id="image0_187_87" width="128" height="128"
                                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAACXBIWXMAAAOwAAADsAEnxA+tAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAACdRJREFUeJztnX+MXUUVxz/vdi0t7VaQCrXStFJasO3aRmppbbFVEEHRWLQqUSpq0KhohYSYYIKJxgSiDWJQQ6QJVTCx4C9KNQQQo/xY+S0V7U8VSiqIIHS7tHS7u/xx9tHXx9vdOffOnbn3vvNJJn3bzLtzZu733fl15twa1eR4YBbwlob0ZmAScBTw+qHPrwMOAL1D3+sDnh1K/xn690ngceAfQ58HQ1UiBLXYBnjgKGAZsLAhHZdTWXsRIdwH/Bm4G3g6p7KMYRgDnApcjtyAPuRXGSttBX4MnIk8UYycWAhchTyaY97wkdLzwE+BDwNj82mG9uJY4DJgC/FvrjY9A1wJnOi9VdqALuA6YB/xb2TWNADcDnyIaoy5cmUp0lixb1pe6RHgXCDx1WBVoQu4hfg3KFTaDHzES8uVnKnIoKmf+DclRroLEX/bUQNWA88R/ybETv3Ij+CNmVo0JTEGJfOBa5G5fEj2IdO0XqAHeHHo80GgE1kZnAAcicw+JgS27xngQmBjyEJDCiABLgW+Tb4LJj1ANzJ13AJsQxZrdimvMwWYPZRmAXOQQerR3ixtzTrgYqQeleE44DbyeYS+BNyBrBcsATpyrEcCLADWAL8kvy7sX4jYKsEZyHq5zwY6APwW+CgwLlxVXsNY4BzgRmSfwHcdvxSuKvnwZaSP9dUoDwJfIdKAaRQmAOcBf8SvENYBR4Srhh/GAFfjrxHuAN4dtAbZWARswJ/4u5GBaSmYCNxK9koPIItDoWcLPpmJzHh87FhuBaaHNV9PJ7JFm7WyDwDvCGx7nnQhT7Gs7bILeGtg252ZBNxDtgo+D3yR6q6VrwR2kK2NngXeHtrw0ZgE3Eu2iq2nRP1cBsYB30e6uCwimBPa8OEYh7hHpa3Mi8DHg1sdnzOB3aRvt6eAGaGNbiZBRrtpK/Ew7e0wMRn4FenbbzuyYhmN77UwyjX9kBLOb3Oghvg3pu0S7ifSYthFKYwdRCr6tQj2Fp3zSO8BtT60sacCL6cwtA/4bGhjS8RiZFcwjQiC/aiOAZ5IYeBe4KxQRpaYk0nn+dwHrMjbuBqyX601rpcK7W4FYC7wX/Tt/CRyUCY3Lk5h1AHg/XkaVVHmk267+ca8DJqJ/JK1A77z8zKoDTgF2INeBN7XVWqkW8u+xLchbchK9FPE5/C8qvoZpQGDwE98GtDmfBN9+6/zVfhk9H3RY8B4XwYY1NCvGPYj08rMXKUsuAeZyhh+mYj4BGjuxQNk3FmdAexXFmqDvvxYiv4QzQVZCrxBWdiGLIUZTqxFd092kNIN/23o1LYHCcNi5Mt49F1BquX3nykLsSlfOJahmxruZJinwHAng6aN9KUWbEbclA465h+NS5BDHrFYi3jiFpmb0Z0w/jRyBtGJ76L79S9XGOLCTcryfadVnuuTB7ORZXbXOt3veuFJiJuW64X/4KM2TZgA3PgRunotbL5AqzniKkQErnxHZbLhk28h2+yuvOaoWSsBrFZcsBu4U5Hf8MvTwPWK/J+g6XRzswCmA6cpLmi//vj8AHm8uzAeCWH3Ks0CWI17zIBtwCbHvEZ+bEd2al05bHzTLADN4Ke+TmDE5xpF3tNp6AYaBTAN94BFg8gysVEMNuEeAWUsErMQOFwAZysK/BPwb0V+I1/6ke1iV86pf2gUgMZvz3lFyQjGrxV5l9M01utA9vFdFhP6gTdkt9fwzBh0Zwq64NAToAtxOHDhUeQYt1Es+pGAGq6sgEMC0ARjuEuR1wjL7xR5l8MhASxSfDGPtX/DD/cp8i5o/OMx3PqNPnT7BEZ4XI/t9QMTE2QA6OrEuRnx/DGKy18c8yXA3ARZ/3d1/NiSyiQjJK4CAJiXIEe+XNmqNMYIzyOKvCcn6EK02BOg+DyhyDs1QV6q6Mo2pTFGeJ5CHEZdmNqBBHxwZbvenlQsRjanqsQuwjiavoysCL7JIe9UgN/gPgUMRWyfwDzSTV5baGS6HW3qSZD36LpQqRcYVJzdjvkmJrhv7JgAyoPz+YwE9xhzGu9ToyRojg7bE6CCJLhPGYwKkuDu2NmZpyFGHBJkV8gFE0AFSYAXHPO6egwZJSIB/ueY154AFaQDefuEa95OwswG1lK9cDPaN5cGoQP3JwDI1vGjOdnSSDfFD9BQCRIkMrUrFv6tYiTodvhOyssQIw4JOi8fE0DFSBAPkv2O+Qv70kIjHfWl4B2O+edhbuGVor4Z9JBj/g50EUSMglMXwL2K75TpLd7GKKQRwHvyMMSIQ10Af8d9T2A+OkdSo8DUBTCAvPnb9Tvn5mPOq5hTaCAaPYJuVXzvU74NMeLQKIBbcHcOOQ04wb85RmgaBbAb9+lgDfikf3OM0DQ7hWpCjJyPe1BJo6A0C+DnuHcDs4AP+jXHCE2zAHYiMQBd+YZHW4wItDoXcJ3i+4uAMzzZYkSglQBuBv6vuIY9BUpMKwHsB9YrrrEC2x8oLR3D/P9a5O0SYx2vcw0SdszXEXJNuLOyULo6rUO31HlpHDONFmzA/b4Ny0zkmLHrhXqRiGNGfJwFMNLp4J3IgNCVI5Guw6gQJ6B/efQFMQw1DsNLF1DnSsXFBpFAEnO8VcVIg1cBdCKHRzQi+BvSJRhx8DIGqNMDXK40YC66FxkZBacG3IbeC8amhnHw2gXUmYFECtcIYICU7643MpGLAAC+oLhwPR0EVmapjaEmNwHUgN8rLl5PvcCyDBUydOQmAJDAkv9UFNAogg+krJChI1cBgGz8vKQopLE7+FzaQg1nchcAiE+gVgD1geHXsxRsjEoQAYDM9dOIYBC4FvcwtYaOYAJIgF8oCmtOjyOLRoZfggkAxGkkzSJRPfVgZwx8E1QAIEEjHlQU2irdAEzxZVCbE1wAIC+euEdRcKv0ArAGeRGykZ4oAgAJJ3unovDh0sPAEt/GtRHRBAAwHjlpnFUEA8Am4J15GFlxogoA5BF+hcKI0dLd2DE0DdEFUOdC5DVmvoTwEPBV4Ni8DS85hREAwLuQ99j5EsEgcADYCHwM6XKMwymUAEB+sRsVRmlSHzIFvQI5p3hEoDoVmcIJAGQreQ2wT2FcmtQD3I4sU18EvBc5r9BOsQycBRCjUeYhp44WBS53H7LOsBfxbNoz9Nk1TG6ZWAIcH9uIkagBq5GXVeT5NLA0Soq54vZX4HpgMhJ7sJ0e0UYTc5B+a4AC/CraLBWKU5DVv9iN0k6pkJwEXI0M0mI3UKVT0fvdo5FzBZ8HZke2pZIUXQCNzAVWIc4jJ0a2pTKUSQB1asgawvuA04HFuIeyMZooowCamYDELl6KTCcXANOiWlQiqiCAVhyDCGE6IoZpyMrYFOS4+zhkE6mT4QNltQWvAPZmaUSvIRgGAAAAAElFTkSuQmCC" />
                                        </defs>
                                    </svg>
                                    <span id="comenCount"
                                        class="text-gray-500 dark:text-gray-300">{{ $data->comments->count() }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @include('page.posts.detail.terkait')
                </div>
            </div>
        </div>
    </section>
    @include('page.posts.detail.comment.comment')
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/detail.js') }}"></script>
    <script src="{{ asset('assets/js/comment-reports.js') }}"></script>
@endpush
