<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/registration_styles.css') }}">
    <!-- Scripts -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Register</title>
</head>
<body>
    <section class="registration__container">
        <div class="image__container"></div>
        <div class="form__container">
            <form method="post" action="{{ route('register') }}" class="form__subcontainer">
                @csrf
                <span class="form__title">REGISTER</span>
                <div class="form__item">
                    <span>Login</span>
                    <input name="name" type="text" value="{{ old('name') }}">
                    <span class="errors-spans">{{ $errors->first('name') }}</span>
                </div>
                <div class="form__item">
                    <span>Email</span>
                    <input name="email" type="email" value="{{ old('email') }}">
                    <span class="errors-spans">{{ $errors->first('email') }}</span>
                </div>
                <div class="form__item">
                    <span>Password</span>
                    <input name="password" type="password" value="{{ old('password') }}">
                    <span class="errors-spans">{{ $errors->first('password') }}</span>
                </div>
                <div class="form__item">
                    <span>Repeat password</span>
                    <input name="repeated__pwd" type="password">
                    <span class="errors-spans">{{ $errors->first('repeated__pwd') }}</span>
                </div>
                <div class="btns">
                    <button class="submit-btn" type="submit">Register</button>
                    <a class="submit-btn login-btn" href="{{ route('login.index') }}">Return to login</a>
                </div>
            </form>
        </div>
    </section>

</body>
</html>
