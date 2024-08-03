<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Pengaduan Layanan </title>


    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">

    {{-- data table --}}
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="sweetalert2.min.css"> --}}

    @stack('styles')
</head>

<body>


    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>

                    </ul>

                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image"
                                src="{{ Auth::user()->image == 'default.jpg' ? asset('img/default.jpg') : asset('storage/' . Auth::user()->image) }}"
                                class="rounded-circle mr-1 avatar-img" width="30" height="30"
                                style="object-fit: cover">
                            <div class="d-sm-none d-lg-inline-block">Hi, <span
                                    class="avatar-name">{{ Auth::user()->name }}</span> </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="/profile/{{ Auth::user()->username }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>

                            <a href="/profile/change-password/{{ Auth::user()->username }}"
                                class="dropdown-item has-icon">
                                <i class="fas fa-key"></i> Ubah Password
                            </a>
                            <div class="dropdown-divider"></div>

                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt mt-2"></i> Logout
                                </button>
                            </form>

                        </div>
                    </li>
                </ul>
            </nav>
