<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')
</head>
<body>
    @include('/components/nav')
    <div class="container">
        <h1 class=" mt-5">Adatok módosítása</h1>

        @include('/components/succesmassage')

        <form action="{{route('profile.update')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nickname" class="form-label">Becenév</label>
                <input name="nickname" type="text" class="form-control" id="nickname" placeholder="thisismynicname" value="{{ old('nickname', $user->name) }}">
            </div>
            @error('nickname')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="b_day" class="form-label">Születési idő</label>
                <input name=b_day type="date" class="form-control" id="b_day" value="{{ old('b_day',$user->birth_day) }}">
            </div>
            @error('b_day')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Add meg a jelszavad..." value="{{ old('password',$user->password) }}">
            </div>
            @error('password')
                <div class="alert alert-danger alert-sm" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <button type="submit" class="btn btn-primary" method="POST" class="mt-3">Mentés</button>
        </form>
    </div>
</body>
</html>
