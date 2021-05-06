<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;



class loginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function process_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('email',$request->email)->first();

        if (auth()->attempt($credentials)) {
            session()->flash('success', 'Welcome to Laravel App');
            return redirect('/');
        }else{
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('login');
    }

}
