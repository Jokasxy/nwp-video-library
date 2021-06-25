<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $id = Auth::id();
        $user = User::find($id);
        $videos = $user->videos()->get();
        $info_borrow = Lang::get('message.info_borrow');

        return view('users.profile', compact('user', 'videos', 'info_borrow'));
    }

}
