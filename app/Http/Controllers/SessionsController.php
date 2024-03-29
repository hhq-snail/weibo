<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);

        $this->middleware('throttle:10,10', [
            'only' => ['store']
        ]);
    }


    public function create ()
    {
        if (Auth::check()) {
            return redirect()->route('users.show', [Auth::user()]);
        }

        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->activated) {
                // 登录成功后的相关操作
                session()->flash('success', '欢迎回来');
                return redirect()->intended(route('users.show', Auth::user()));
            } else {
                Auth::logout();
                session()->flash('waring', '您的账号未激活,请检查邮箱中的注册邮件');
                return redirect('/');
            }


        } else {
            // 登录失败后的相关操作
            session()->flash('danger', '很抱歉,您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出');

        return redirect()->route('login');
    }
}
