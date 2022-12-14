<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.1
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!-- Breadcrumb-->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Grabbit">
    <meta name="author" content="Unknown">
    <meta name="keyword" content="RABBIT, rabbit, rabit, grab it">
    <title>Grabbit</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/logo.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/logo.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/logo.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/logo.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/logo.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/logo.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/logo.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/logo.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/logo.png">
    <link rel="manifest" href="/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="/css/examples.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>

@livewireStyles
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
</head>

<body>

@include('sweetalert::alert')
    <x-sidebar></x-sidebar>
    <div class="alert alert-success alert-dismissible fade show alert-show" role="alert">
        <span class="alert-messages"></span>
        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <img style="width:50px; height:40px;   object-fit: cover; margin-left:-110px;" src="/logo.png" alt="">
                    </svg></a>
                <ul class="header-nav d-none d-md-flex">
                    <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>

                </ul>

                <form class="card-body" method="GET" action="/result">
                    <div class="form-group d-flex " style="align-items: center;">
                        <input id="typed4" name="search" type="text" class="form-control" value="" placeholder="Search post">
                        <button class="mx-2 btn btn-primary">search</button>
                    </div>
                </form>

                <ul class="header-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('notification.index')}}">
                            <svg class="icon icon-lg">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                            </svg>
                            @if (count(auth()->user()->unreadNotifications()))
                                <span class="badge-sm bg-danger badge">
                                    {{count(auth()->user()->unreadNotifications())}}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('message.conversations')}}">
                            <svg class="icon me-2">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md">
                                <img class="avatar-img-nav" src="/storage/{{auth()->user()->profile->avatar ?? ''}}"alt="Profile Picture">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">Account</div>
                            </div>
                                <a class="dropdown-item" href="{{route('meetup.showrequestedmeetuplist')}}">
                                    <svg class="icon me-2">
                                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                                    </svg> My Request
                                </a>
                                <a class="dropdown-item" href="{{route('meetup.showrequestmeetuplist')}}">
                                    <svg class="icon me-2">
                                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                                    </svg> Others Request
                                </a>
                                <a class="dropdown-item" href="{{route('block.blockuserlist')}}">
                                    <svg class="icon me-2">
                                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user-x"></use>
                                    </svg> Block Users
                                </a>

                            <div class="dropdown-header bg-light py-2">
                            </div><a class="dropdown-item" href="/profile/show/{{auth()->user()->id}}">
                                <svg class="icon me-2">
                                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                </svg> Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                                </svg> Logout</a>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="header-divider"></div>
            <div class="container-fluid">
                @yield('breadcrumb')
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div><a href="#">Grabbit.</div>
        </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="/vendors/simplebar/js/simplebar.min.js"></script>
    <script></script>
    @livewireScripts

    <script>
        var typed4 = new Typed('#typed4', {
            strings: [
                @foreach(\App\Models\Post::inRandomOrder()->take(10)->get() as $item)
                    "{{$item->title}}",
                @endforeach
            ],
            typeSpeed: 27,
            backSpeed: 25,
            attr: 'placeholder',
            bindInputFocusEvents: true,
            loop: true
        });
    </script>
</body>

</html>
