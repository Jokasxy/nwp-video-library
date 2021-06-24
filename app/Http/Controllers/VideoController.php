<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class VideoController extends Controller
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
        $videos = Video::all()->sortBy('name');
        return view('videos.home', compact('videos','info_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        Video::create($request->validated());
        $message = Lang::get('message.success_create');
        return redirect('/videos')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $info_delete = Lang::get('message.info_delete');
        return view('videos.show', compact('video','info_delete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        if ($video == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/videos')->with('error', $message);
        }
        return view('videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, Video $video)
    {
        if ($video == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/videos')->with('error', $message);
        }
        $validated = $request->validated();
        $video->fill($validated)->save();
        $message = Lang::get('message.success_edit');
        return redirect('/videos')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        if ($video == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/videos')->with('error', $message);
        } else if ($video->videos()->count() > 0) {
            $message = Lang::get('message.error_delete');
            return redirect('/videos')->with('error', $message);
        }
        $video->delete();
        $message = Lang::get('message.success_delete');
        return redirect('/videos')->with('success', $message);
    }
}
