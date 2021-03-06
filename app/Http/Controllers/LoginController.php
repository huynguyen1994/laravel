<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Validator, Redirect, Response;
use Auth;
use App\Http\Models\User;
use Session;
use Socialite;


class LoginController extends Controller
{
    /**
     * Get View Amp
     *
     * @param  String $viewName
     *
     */
    private function getView($viewName)
    {
        if (request()->segment(1) == 'amp') {
            if (view()->exists($viewName . '-amp')) {
                $viewName .= '-amp';
            } else {
                abort(404);
            }
        }
        return $viewName;
    }

    /**
     * Display a login
     *
     *
     * @return Auth
     *
     */
    public function index()
    {
        if (Auth::check()) {
            return view($this->getView('backend.dashboard.index'));
        } else {
            return view($this->getView('login'));
        }

    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index_amp()
    {
        return view($this->getView('amp.login-amp'));
    }


    /**
     * Display a listing of the shop.
     *
     *
     */
    public function shopCartAmp()
    {
        return view($this->getView('amp.shopCart-amp'));
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
                return redirect()->route('backend.dashboard')->with('success', 'Đăng nhập thành công !!!');
            } else {
                Session::flash('error', 'Email hoặc mật khẩu không đúng!');
                return view($this->getView('login'));
            }
        }
    }

    /**
     * LogOut
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Redirect To Provider
     *
     * @return  Redirect
     * @return  Socialite
     */
    public function redirectToProvider()
    {

        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Provider Callback
     *
     * @return \Illuminate\Http\Response
     * @return  Auth
     * @return  Redirect
     * @return  Socialite
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);
        return redirect('/backend');
    }

    /**
     * Find Or Create User
     *
     * @param  Id $user
     *
     */
    private function findOrCreateUser($user)
    {
        $authUser = User::where('social_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        } else {
            return User::create([
                'name' => $user->name,
                'email' => $user->email??"",
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

    /**
     * Redirect
     *
     * @return  Redirect
     * @return  Socialite
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback
     *
     * @return Socialite
     * @return Auth
     */
    public function callback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return view($this->getView('login'));
        }

        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
            return view($this->getView('backend.dashboard.index'));
        } else {
            $newUser = $this->findOrCreateUser($user);
            Auth::login($newUser);
            return view($this->getView('backend.dashboard.index'));
        }
    }

    /**
     * Redirect To Provider Line
     *
     * @return  Redirect
     * @return  Socialite
     */
    public function redirectToProviderLine()
    {
        return Socialite::driver('line')->redirect();
    }

    /**
     * Handle Provider CallBack Line
     *
     * @return  Redirect
     * @return  Socialite
     * @return Session
     */
    public function handleProviderCallBackLine()
    {
        try {
            $user = Socialite::driver('line')->stateless()->user();
        } catch (Exception $e) {
            Session::flash('error', 'Lỗi đăng nhập Line');
            return view($this->getView('login'));
        }
        $existingUser = User::where('social_id', $user->id)->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
            return view($this->getView('backend.dashboard.index'));
        } else {
            $newUser = $this->findOrCreateUser($user);
            Auth::login($newUser);
            return view($this->getView('backend.dashboard.index'));
        }

    }
}