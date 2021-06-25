<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Star;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $info_borrow = Lang::get('message.info_borrow');
        $videos = Video::all()->sortBy('name');
        return view('videos.home', compact('videos', 'info_delete', 'info_borrow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directors = Director::all()->sortBy('name');
        $stars = Star::all()->sortBy('name');
        $genres = Genre::all()->sortBy('name');

        return view('videos.create', compact('directors', 'stars', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $video = Video::create($request->validated());
        $message = Lang::get('message.success_create');

        $star_ids = $request->input('star_ids');
        $genre_ids = $request->input('genre_ids');
        foreach ($star_ids as $star_id) {
            DB::table('videos_stars')->insert([
                'video_id' => $video->id,
                'star_id' => $star_id,
            ]);
        }
        foreach ($genre_ids as $genre_id) {
            DB::table('videos_genres')->insert([
                'video_id' => $video->id,
                'genre_id' => $genre_id,
            ]);
        }

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
        $info_borrow = Lang::get('message.info_borrow');
        return view('videos.show', compact('video', 'info_delete', 'info_borrow'));
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
        $directors = Director::all()->sortBy('name');
        $stars = Star::all()->sortBy('name');
        $genres = Genre::all()->sortBy('name');

        return view('videos.edit', compact('video', 'directors', 'stars', 'genres'));
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

        $star_ids = $request->input('star_ids');
        $genre_ids = $request->input('genre_ids');

        DB::table('videos_stars')->where('video_id', $video->id)->delete();
        DB::table('videos_genres')->where('video_id', $video->id)->delete();

        foreach ($star_ids as $star_id) {
                DB::table('videos_stars')->insert([
                    'video_id' => $video->id,
                    'star_id' => $star_id,
                ]);
        }
        foreach ($genre_ids as $genre_id) {
                DB::table('videos_genres')->insert([
                    'video_id' => $video->id,
                    'genre_id' => $genre_id,
                ]);
        }

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
        }
        $video->delete();
        $message = Lang::get('message.success_delete');
        return redirect('/videos')->with('success', $message);
    }

    public function borrow(Video $video) {
        if ($video == null) {
            $message = Lang::get('message.error_undefined');
            return redirect('/videos')->with('error', $message);
        }

        $user_id = Auth::id();
        $video_ids = User::find($user_id)->videos()->get()->pluck('id')->toArray();

        if(in_array($video->id, $video_ids)) {
            DB::table('users_videos')->where('user_id', $user_id)->where('video_id', $video->id)->delete();
        }
        else {
            DB::table('users_videos')->insert([
                'user_id' => $user_id,
                'video_id' => $video->id,
            ]);
        }

        $message = Lang::get('message.success_borrow');
        return redirect('/videos')->with('success', $message);
    }
}
