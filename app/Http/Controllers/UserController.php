<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function Register(Request $request) {
        $validated = $request->validate([
            'emailform' => 'required|email|unique:users,email',
            'nickname' => 'required|max:20',
            'b_day' => 'required|date|before:2006-01-01',
            'password' => 'required|min:8',
            'password_confirmation' => 'same:password',
        ], [
            'emailform.required' => 'Az email cím megadása kötelező!',
            'emailform.unique' =>'Ezzel az emil címmel már regisztráltak!',
            'emailform.email' => 'A megadott email cím nem érvényes!',
            'nickname.required' => 'A becenév megadása kötelező!',
            'nickname.max' => 'A becenév legfeljebb 20 karakter hosszú lehet!',
            'b_day' => 'A születési idő megadása kötelező',
            'password.required' => 'A jelszó megadása kötelező!',
            'password.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie!',
            'password_confirmation' => 'A két jelszónak meg kell egyeznie!'
        ]);


        $user = User::create([
            'email' => $validated['emailform'],
            'name' => $validated['nickname'],
            'birth_day' => $validated['b_day'],
            'password' => bcrypt($validated['password']),
        ]);

        $filePath = $this->saveToFile($user); #file-ba kimentés

        $user->file_storage_path = $filePath;
        $user->save();

        session()->flash('success', 'Sikeres regisztráció!');


        return redirect()->route(route: 'register');

    }

    private function saveToFile($user)
    {
        $data = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        $filePath = 'users/' . $user->id . '.json';
        Storage::disk('local')->put($filePath, json_encode($data, JSON_PRETTY_PRINT));

        return $filePath;
    }


    public function Login(Request $request)
    {

        $validated = $request->validate([
            'emailform' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'emailform.required' => 'Az email cím megadása kötelező!',
            'emailform.email' => 'A megadott email cím nem érvényes!',
            'password.required' => 'A jelszó megadása kötelező!',
            'password.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie!',
        ]);

        $user = User::where('email', $validated['emailform'])->first();

        if (!$user) {
            return back()->withErrors([
                'emailform' => 'Nincs regisztrált felhasználó ezzel az email címmel!',
            ])->withInput();
        }

        // Ha létezik a felhasználó, akkor próbáljuk meg az autentikációt a jelszóval
        if (!auth()->attempt(['email' => $validated['emailform'], 'password' => $validated['password']])) {
            return back()->withErrors([
                'emailform' => 'Hibás email cím vagy jelszó!',
            ])->withInput();
        }

        session()->flash('success', 'Sikeres bejelentkezés!');
        return redirect()->intended(route('home'));


    }
    public function Logout()
    {
        auth()->logout(); // Felhasználó kijelentkeztetése
        session()->flush(); // Munkamenet ürítése
        session()->flash('success', 'Sikeresen kijelentkeztél!');
        return redirect()->route('login'); // Visszairányítás a bejelentkezési oldalra
    }

    public function Edit(){
        return view('profile.edit',['user'=> Auth::user()]);
    }
    public function Update(Request $request){
        $user = Auth::user();

        $validated = $request->validate([
            'nickname' => 'required|max:20',
            'b_day' => 'required|date|before:2006-01-01',
            'password' => 'required|min:8',
        ],[
            'nickname.required' => 'A becenév megadása kötelező!',
            'nickname.max' => 'A becenév legfeljebb 20 karakter hosszú lehet!',
            'b_day' => 'A születési idő megadása kötelező',
            'password.required' => 'A jelszó megadása kötelező!',
            'password.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie!',
        ]);

        $user->name = $validated['nickname'];
        $user->birth_day = $validated['b_day'];
        $user->password = $validated['password'];


        $user -> save();

        return redirect()->route('profile.edit')->with('success','Profil sikeresen frissítve!');
    }

}
