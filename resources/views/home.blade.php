<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')
</head>
<body>
    @include('/components/nav')

   <div class="container mt-5">

    @include('/components/succesmassage')

    <h1 class="h1">Üdvözlöm {{ auth() ->user()->name}} !</h1>

    <div class="container">
        <h2>Felhasználói adatok</h2>
        <div class="row">

        </div>
        <div class="row">
            <div class="button mt-5">
                <a href="{{route('profile.edit')}}" class="btn btn-primary">Adatok módosítása</a>
            </div>
        </div>
    </div>



   </div>
</body>
</html>
