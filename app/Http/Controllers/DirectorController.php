<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info_delete = Lang::get('message.info_delete');
        $directors = Director::all()->sortBy('name');
        return view('directors.home', compact('directors','info_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('directors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Director::create($request->validated());
        $message = Lang::get('message.success_create');
        return redirect('/directors')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info_delete = Lang::get('message.info_delete');
        $director = Director::find($id);
        return view('directors.show', compact('director','info_delete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $director = Director::find($id);
        if ($director == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/authors')->with('error', $message);
        }
        return view('authors.update', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $director = Director::find($id);
        if ($director == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/authors')->with('error', $message);
        }
        $validated = $request->validated();
        $director->fill($validated)->save();
        $message = Lang::get('message.success_edit');
        return redirect('/authors')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $director = Director::find($id);
        if ($director == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/directors')->with('error', $message);
        } else if ($director->books()->count() > 0) {
            $message = Lang::get('message.error_delete');
            return redirect('/directors')->with('error', $message);
        }
        $director->delete();
        $message = Lang::get('message.success_delete');
        return redirect('/directors')->with('success', $message);
    }
}
