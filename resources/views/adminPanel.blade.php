<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/admin_panel_styles.css') }}">
    <!-- Scripts -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Admin panel</title>
</head>
<body>
    <section>
        <nav class="navbar navbar-dark bg-dark ">
            <div class="container-fluid">

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar"
                    aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="offcanvas offcanvas-start text-bg-dark"
                    tabindex="-1"
                    id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel"
                >
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">ADMIN MENU</h5>
                        <button
                            type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#" role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Tables
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">

                                    @foreach($tables as $table)
                                        <li><a class="dropdown-item" href="{{route('tableWidget', $table)}}">{{$table}}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </section>




        @if(request()->hasAny($tables))
            @yield('tableWidget')
        @else
        <div style="text-align: center; padding-top: 1em">
            <span class="head-title">GLOBAL STATISTICS</span>
            <hr/>
        </div>
        <section class="statistics">

            <div class="card" style="width: 18rem;">
                <div class="card-img-top interactive-info-block">{{count($tables)}}</div>

                <div class="card-body">
                    <p class="card-text">Number of tables in DataBase</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-img-top interactive-info-block">{{count($migrations)}}</div>

                <div class="card-body">
                    <p class="card-text">Number of migrations in DataBase</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-img-top interactive-info-block">{{count($users)}}</div>

                <div class="card-body">
                    <p class="card-text">Amount of users</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-img-top interactive-info-block">{{count($posts)}}</div>

                <div class="card-body">
                    <p class="card-text">Amount of posts</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-img-top interactive-info-block">{{count($categories)}}</div>

                <div class="card-body">
                    <p class="card-text">Amount of categories</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-img-top interactive-info-block">{{count($tags)}}</div>

                <div class="card-body">
                    <p class="card-text">Amount of tags</p>
                </div>
            </div>
        </section>
        @endif

</body>
</html>
