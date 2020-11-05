<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased">

        <div class="wrapper">

            <!-- Sidebar  -->
            <nav id="sidebar" class="sidebar">
                {{-- <div class="sidebar-header"> --}}
                   <a class="sidebar-brand" href="{{ route('dashboard') }}">
                        {{-- <x-jet-application-mark class="block h-9 w-auto" /> --}}
                        <img width="31px" src="{{ asset('Logo.png') }}" style="vertical-align:middle"/>
                    </a>
                {{-- </div> --}}

                <div class="sidebar-content">
                    <div class="sidebar-user">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle mb-2" style="margin-left: 30px">
                        <div class="font-weight-bold">{{ Auth::user()->name }}</div>
                        <small>Front-end Developer</small>
                    </div>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Main
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('dashboard')}}" class="sidebar-link" :active="request()->routeIs('dashboard')">
                                <i class="align-middle mr-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('buku')}}" class="sidebar-link">
                                <i class="align-middle mr-2 fas fa-fw fa-book"></i> <span class="align-middle">List Buku</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('kategori')}}" class="sidebar-link">
                                <i class="align-middle mr-2 fas fa-fw fa-bookmark"></i> <span class="align-middle">List Kategori</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#transaksi" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle mr-2 fas fa-fw fa-shopping-bag"></i> <span class="align-middle">Transaksi</span>
                            </a>
                            <ul id="transaksi" class="sidebar-dropdown list-unstyled collapse ml-5" data-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="{{route('peminjaman')}}">Peminjaman</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="{{route('pengembalian')}}">Pengembalian</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="{{route('laporan')}}">Laporan</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('member')}}">
                                <i class="align-middle mr-2 fas fa-fw fa-id-card-alt"></i> <span class="align-middle">Member</span>
                            </a>
                        </li>

                        <li class="sidebar-header">
                            Elements
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('profile.show') }}" class="sidebar-link">
                                <i class="align-middle mr-2 fas fa-fw fa-user"></i> <span class="align-middle">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            Extras
                        </li>
                        <li class="sidebar-item">
                            <a href="#layouts" class="sidebar-link">
                                <i class="align-middle mr-2 fas fa-fw fa-sign-out-alt"></i> <span class="align-middle">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- <ul class="list-unstyled components">
                    <p>Dummy Heading</p>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">Home 1</a>
                            </li>
                            <li>
                                <a href="#">Home 2</a>
                            </li>
                            <li>
                                <a href="#">Home 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                            <li>
                                <a href="#">Page 2</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Portfolio</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                    </li>
                    <li>
                        <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                    </li>
                </ul> --}}
            </nav>


            <div id="content" class="min-h-screen bg-gray-100">
                @livewire('navigation-dropdown')

                <!-- Page Heading -->
                {{-- <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header> --}}

                <!-- Page Content -->
                <main class="page-content">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts

        <script type="text/javascript">
            window.livewire.on('userStore', () => {
                $('#exampleModal').modal('hide');
            });
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
