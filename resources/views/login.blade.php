<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')
</head>
<body>
    @include('/components/nav')

    <div class="container mt-5">
        <form action="" method="POST">
            @csrf
            <h1 class="h1">Bejelentkezés</h1>
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
                <label for="password" class="form-label">Jelszó</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Add meg a jelszavad..." value="{{ old('password') }}">
            </div>
            @error('password')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <div class="btn_holder d-flex justify-content-end">
                <button class="btn btn-primary me-3" type="submit">Bejelentkezés</button>
                <a href="{{route('register')}}">Nincs még fiókod? <span class="smaller-text">Regisztrálj!</span></a>
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
