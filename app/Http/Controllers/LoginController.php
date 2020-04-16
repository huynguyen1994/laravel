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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/backend');
        } else {
            return view('login');
        }

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
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect('/backend');
        } else {
            $newUser = $this->findOrCreateUser($user);
            Auth::login($newUser);
            return redirect('/backend');
        }
    }

    public function redirectToProviderLine()
    {
        return Socialite::driver('line')->stateless()->redirect();
    }

    public function handleProviderCallBackLine(Request $request, SocialAccountsService $accountService, $provider)
    {
        try {
            $user = Socialite::with($provider)->user();
        }catch (Exception $e) {
            Session::flash('error', 'Lỗi đăng nhập Line');
            return redirect()->route('/');
        }
        $authUser = $accountService->find($user, $provider);
        if ($authUser) {
            Auth::login($authUser);
            return redirect('/backend');
        } else {
            \Session::put("line_user_id", $user->id);
            return redirect()->route('register');
        }
    }
}
