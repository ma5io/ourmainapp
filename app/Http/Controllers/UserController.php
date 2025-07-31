<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    public function storeAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|max:6000'
        ]);

        $user = auth()->user(); // check which authenticated user uploads the avatar

        $filename = $user->id . "-" . uniqid() . ".jpg"; // use that user's id and create a unique file name

        $manager = new ImageManager(new Driver()); // opens ImageManager and uses Driver
        $image = $manager->read($request->file('avatar')); // opens the uploded image and store it in this variable
        $imgData = $image->cover(120, 120)->toJpeg(); // turns that $image to 120x120 and store it to this variable
        Storage::disk('public')->put('avatars/' . $filename, $imgData); // saves it in the given directory

        $oldAvatar = $user->avatar; // store it to this variable, so that we could delete it later

        $user->avatar = $filename; // sets the avatar to the newly generated filename
        $user->save();

        if ($oldAvatar != "/fallback-avatar.jpg") { // if the image isnt the fallback image, delete it
            Storage::disk('public')->delete(str_replace("/storage/", "", $oldAvatar));
        }

        return back()->with('success', 'Congrats on the new avatar!');
    }

    public function showAvatarForm() {
        return view('avatar-form');
    }

    public function profile(User $user) { // passing data from controller to
        return view('profile-posts', ['avatar' => $user->avatar, 'username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'postCount' => $user->posts()->count()]);
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
