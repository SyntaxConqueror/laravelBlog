<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/login_styles.css') }}">
    <!-- Scripts -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Register</title>
</head>
<body>
<section class="registration__container">
    <div class="image__container"></div>
    <div class="form__container">
        <form method="post" action="{{ route('login') }}" class="form__subcontainer">
            @csrf
            <span class="form__title">LOGIN</span>
            <div class="form__item">
                <span>Email</span>
                <input name="email" type="email"/>
                <span class="errors-spans">{{ $errors->first('email') }}</span>
            </div>
            <div class="form__item">
                <span>Password</span>
                <input name="password" type="password"/>
                <span class="errors-spans">{{ $errors->first('password') }}</span>
            </div>
            <div class="btns">
                <button class="sumbit-btn" type="submit">Login</button>
                <a class="sumbit-btn register-btn" href="/register">Go to register</a>

            </div>


        </form>
    </div>
</section>

</body>
</html>
