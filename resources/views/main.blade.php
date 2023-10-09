<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Scripts -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <section id="header">
        <nav class="navbar navbar-expand-lg bg-secondary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Test Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $category)
                                    <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link {{ auth()->user()->role == 'Admin' ? '' : 'disabled'  }}"
                                href={{route('adminPanel')}} aria-disabled="true"
                            >Admin panel
                            </a>
                        </li>
                    </ul>

                    <form method="GET" action={{ route('get.posts.by.search') }} class="d-flex" role="search">
                        @csrf
                        <input name="post__title" class="form-control custom-search-input me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success me-2" type="submit">Search</button>
                    </form>
                    @if (auth()->check())
                        <form method="POST" action="{{ route('logout') }}" class="me-2">
                            @csrf
                            <button type="submit" class="btn btn-primary loginHref">Logout</button>
                        </form>
                    @else
                        <a href="{{route('login.index')}}" class="btn btn-primary loginHref">Login</a>
                    @endif
                </div>
            </div>
        </nav>
    </section>

    <h3 class="ms-2 mt-2">Blog content</h3>

    <section id="blog-content">
        <div class="blog-container scrollable-div me-2">
            @foreach($posts as $post)
                <div class="card w-100 mb-3">
                    <img src="{{$post->preview}}" height="200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <p class="card-text">
                            <small class="text-body-secondary">
                                Last updated {{$post->updated_at == null ? "3 mins ago" : $post->updated_at}}
                            </small>
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
        <form method="GET" action="{{ route('get.posts.by.params') }}" class="blog-category-tags-container">
            @csrf <!-- Add a CSRF token for security -->

            <span class="ms-1">Choose category</span>
            <div class="category-cont mb-4">
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <input class="form-check-input custom-radio me-1"
                                   type="radio"
                                   name="category"
                                   value="{{ $category->id }}"
                                   id="{{ $category->id }}Radio"
                            >
                            <label class="form-check-label" for="{{ $category->id }}Radio">{{ $category->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <span class="ms-1">Choose tags</span>
            <div class="tags-cont">
                <ul class="list-group">
                    @foreach($tags as $tag)
                        <li class="list-group-item">
                            <input class="form-check-input custom-radio me-1"
                                   type="checkbox"
                                   name="tags[]"
                                   value="{{ $tag->id }}"
                                   id="{{ $tag->id }}CheckboxStretched"
                                   @if(in_array($tag->id, session('selected_tags', [])))
                                       checked
                                @endif
                            >
                            <label class="form-check-label stretched-link" for="{{ $tag->id }}CheckboxStretched">{{ $tag->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="float-end commit-btn mt-4">
                <button class="btn btn-success commit-btn" type="submit">Commit</button>
            </div>
        </form>
    </section>
</body>
</html>
