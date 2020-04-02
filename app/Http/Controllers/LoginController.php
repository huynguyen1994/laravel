<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\Http\Models\User;
use Session;
use Illuminate\Support\Facades\DB;

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
            $email = trim($request->input('email'));
            $password = trim($request->input('password'));
            $password = md5('git'.$password);
            $users = DB::table('users')->where([
                ['email', '=', $email],
                ['password', '=', $password],
            ])->first();
            if ($users) {
                $sessionInfo = [
                    'id' => $users->id,
                    'email' => $users->email,
                    'name' => $users->name,
                    'phone' => $users->phone
                ];
                $request->session()->put('users', $sessionInfo);
                return redirect()->route('backend.dashboard');
            } else {
                Session::flash('error', 'Email hoặc mật khẩu không đúng!');
                return redirect('/');
            }
        }
    }

    public function logout(Request $request) {
        $request->session()->forget('users');
        return redirect('/');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
