<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')
</head>
<body>
    @include('/components/nav')

    <div class="container mt-5">

        @include('/components/succesmassage')

        <form action="" method="POST">
            @csrf
            <h1 class="h1">Regisztráció</h1>
            <div class="mb-3">
                <label for="emailform" class="form-label">Email cím</label>
                <input name="emailform" type="email" class="form-control" id="emailform" placeholder="name@example.com" value="{{ old('emailform') }}">
            </div>
            @error('emailform')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="nickname" class="form-label">Becenév</label>
                <input name="nickname" type="text" class="form-control" id="nickname" placeholder="thisismynicname" value="{{ old('nickname') }}">
            </div>
            @error('nickname')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="b_day" class="form-label">Születési idő</label>
                <input name=b_day type="date" class="form-control" id="b_day" value="{{ old('b_day') }}">
            </div>
            @error('b_day')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Add meg a jelszavad..." value="{{ old('password') }}">
            </div>
            @error('password')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Jelszó újra</label>
                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Add meg a jelszavad újra..." value="{{ old('password_confirmation') }}">
            </div>
            @error('password_confirmation')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <div class="btn_holder d-flex justify-content-end">
                <button class="btn btn-primary me-3" type="submit">Regisztráció</button>
                <a href="{{route('login')}}">Már van fiókod? <span class="smaller-text">Kattints ide!</span></a>
            </div>
        </form>


    </div>
</body>
</html>
<style>
    a {
    display: inline-block;
    line-height: 1.2;
    }

    .smaller-text {
    font-size: 0.8em;
    display: block;
    text-align: center;
    margin: 0 auto;
    }
</style>
