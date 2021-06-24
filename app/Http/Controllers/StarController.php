<?php

namespace App\Http\Controllers;

use App\Http\Requests\StarRequest;
use App\Models\Star;
use Illuminate\Support\Facades\Lang;

class StarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info_delete = Lang::get('message.info_delete');
        $stars = Star::all()->sortBy('name');
        return view('stars.home', compact('stars','info_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StarRequest $request)
    {
        Star::create($request->validated());
        $message = Lang::get('message.success_create');
        return redirect('/stars')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Star $star)
    {
        $info_delete = Lang::get('message.info_delete');
        return view('stars.show', compact('star','info_delete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Star $star)
    {
        if ($star == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/stars')->with('error', $message);
        }
        return view('stars.edit', compact('star'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StarRequest $request, Star $star)
    {
        if ($star == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/stars')->with('error', $message);
        }
        $validated = $request->validated();
        $star->fill($validated)->save();
        $message = Lang::get('message.success_edit');
        return redirect('/stars')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Star $star)
    {
        if ($star == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/stars')->with('error', $message);
        } else if ($star->videos()->count() > 0) {
            $message = Lang::get('message.error_delete');
            return redirect('/stars')->with('error', $message);
        }
        $star->delete();
        $message = Lang::get('message.success_delete');
        return redirect('/stars')->with('success', $message);
    }
}
