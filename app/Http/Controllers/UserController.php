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
        $info_return = Lang::get('message.info_return');

        return view('users.profile', compact('user', 'videos', 'info_return'));
    }

}
