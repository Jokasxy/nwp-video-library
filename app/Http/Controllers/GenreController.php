<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Support\Facades\Lang;

class GenreController extends Controller
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
        $genres = Genre::all()->sortBy('name');
        return view('genres.home', compact('genres','info_delete'));
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
    public function store(GenreRequest $request)
    {
        Genre::create($request->validated());
        $message = Lang::get('message.success_create');
        return redirect('/genres')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        $info_delete = Lang::get('message.info_delete');
        return view('genres.show', compact('genre','info_delete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        if ($genre == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/genres')->with('error', $message);
        }
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        if ($genre == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/genres')->with('error', $message);
        }
        $validated = $request->validated();
        $genre->fill($validated)->save();
        $message = Lang::get('message.success_edit');
        return redirect('/genres')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        if ($genre == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/genres')->with('error', $message);
        } else if ($genre->videos()->count() > 0) {
            $message = Lang::get('message.error_delete');
            return redirect('/genres')->with('error', $message);
        }
        $genre->delete();
        $message = Lang::get('message.success_delete');
        return redirect('/genres')->with('success', $message);
    }
}
