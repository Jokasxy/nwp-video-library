@extends('layouts.app')
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@elseif(session('warning'))
<div class="alert alert-warning">
    {{session('warning')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif
<div class="container videos">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="padding:0px">
                    <h4 id="title">{{ __('form.video_title') }}</h4>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">{{ __('form.video_name') }}</th>
                            <th style="text-align:center">{{ __('form.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $video)
                        <tr>
                            <td style="text-align:center">
                                <img src="{{ $video->image }}" style="max-width:100%; max-height:200px; object-fit:contain;" />
                                <h5>{{$video->name}}</h5>
                                <p>{{$video->description}}</p>
                                <p>{{$video->director->name}}</p>
                                <ul>
                                    {{ __('form.video_stars') }}
                                    @forelse ($video->stars as $star)
                                        <li>{{$star->name}}</li>
                                    @empty
                                        <li>{{ __('form.video_no_stars') }}</li>
                                    @endforelse
                                </ul>
                                <ul>
                                    {{ __('form.video_genres') }}
                                    @forelse ($video->genres as $genre)
                                        <li>{{$genre->name}}</li>
                                    @empty
                                        <li>{{ __('form.video_no_genres') }}</li>
                                    @endforelse
                                </ul>
                            </td>
                            @can('borrow')
                            <td style="text-align:center;">
                                <form method="POST" action="/videos/borrow/{{$video->id}}" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}

                                    <input type="submit" class="btn btn-small btn-danger" value="{{ __('form.return') }}" onClick="return confirm('{{$info_return}}')">
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td style="text-align:center"><b>{{ __('form.video_empty') }}</b></td>
                            @can('modify')
                            <td style="text-align:center"></td>
                            @endcan
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
