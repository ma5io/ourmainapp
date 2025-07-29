<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function storeAvatar(Request $request) {
        $request->file('avatar')->store('avatars', 'public');
        return 'hey';
    }

    public function showAvatarForm() {
        return view('avatar-form');
    }

    public function profile(User $user) { // passing data from controller to
        return view('profile-posts', ['username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'postCount' => $user->posts()->count()]);
    }

    public function logout() {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out.'); // flash message
    }

    public function showCorrectHomepage() {
        if (auth()->check()) {  // logged in
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate(); // gives user a new session cookie
            return redirect('/')->with('success', 'You have successfully logged in.'); // flash message
        } else {
            return redirect('/')->with('failure', 'Invalid login.'); // flash message
        }
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);
        $user = User::create($incomingFields);
        auth()->login($user); // login automatically after user registers an account
        return redirect('/')->with('success', 'Thank you for creating an account.'); // flash message
    }
}
