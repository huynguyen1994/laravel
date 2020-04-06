<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use Auth;
use App\Http\Models\User;
use Session;
use Socialite;

class LoginController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        if ($validatedData) {
            $userData = [
                'email' => trim($request->input('email')),
                'password' => trim($request->input('password'))
            ];
            if (Auth::attempt($userData)) {
                return redirect()->route('backend.dashboard');
            } else {
                Session::flash('error', 'Email hoặc mật khẩu không đúng!');
                return redirect('/');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {

        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);
        return redirect('/backend');
    }

    private function findOrCreateUser($user)
    {
        $authUser = User::where('social_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        } else {
            return User::create([
                'name' => $user->name,
                'email' => $user->email,
                'remember_token' => $user->token,
                'social_id' => $user->id,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $existingUser = User::where('email', $googleUser->email)->first();
            if ($existingUser) {
                dd($existingUser);
                // log them in
                Auth::login($googleUser);
            } else {
                // create a new user
                dd(1);
                $newUser = $this->findOrCreateUser($googleUser);
                Auth::login($newUser);
                return redirect('/backend');
            }
        } catch (\Exception $e) {
            return 'error';
        }
//        try {
//            $user = Socialite::driver('google')->user();
//        } catch (\Exception $e) {
//            return redirect('/login');
//        }
//        // only allow people with @company.com to login
//        if (explode("@", $user->email)[1] !== 'company.com') {
//            return redirect()->to('/');
//        }
//        // check if they're an existing user
//        $existingUser = User::where('email', $user->email)->first();
//        if ($existingUser) {
//            // log them in
//            auth()->login($existingUser, true);
//        } else {
//            // create a new user
//            $newUser = new User;
//            $newUser->name = $user->name;
//            $newUser->email = $user->email;
//            $newUser->google_id = $user->id;
//            $newUser->avatar = $user->avatar;
//            $newUser->avatar_original = $user->avatar_original;
//            $newUser->save();
//            auth()->login($newUser, true);
//        }
        //        return redirect()->to('/backend');
    }
}
