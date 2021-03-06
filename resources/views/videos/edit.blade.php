@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="post" action="{{ url('/videos/update', array($video->id)) }}">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="card-header" style="padding:0px">
                        <h4 id="title">{{ __('form.video_edit') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('form.video_name') }}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" value="<?php echo $video->name; ?>">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <label>{{ __('form.video_description') }}</label>
                            <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="<?php echo $video->description; ?>">
                            @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                            <label>{{ __('form.video_image') }}</label>
                            <input type="text" name="image" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" value="<?php echo $video->image; ?>">
                            @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            <label>{{ __('form.video_director') }}</label>
                            <select name="director_id" class="form-control {{ $errors->has('director_id') ? 'has-error' : '' }}">
                            @foreach ($directors as $director)
                                <option value="{{$director->id}}" {{ $video->director_id === $director->id ? 'selected' : '' }}>
                                    {{$director->name}}
                                </option>
                            @endforeach
                            </select>
                            @if ($errors->has('director_id'))
                            <span class="text-danger">{{ $errors->first('director_id') }}</span>
                            @endif
                            <label>{{ __('form.video_stars') }}</label>
                            <select multiple name="star_ids[]" class="form-control {{ $errors->has('star_ids') ? 'has-error' : '' }}">
                            @foreach ($stars as $star)
                                <option value="{{$star->id}}" {{ in_array($star->id, $video->stars->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{$star->name}}
                                </option>
                            @endforeach
                            </select>
                            @if ($errors->has('star_ids'))
                            <span class="text-danger">{{ $errors->first('star_ids') }}</span>
                            @endif
                            <label>{{ __('form.video_genres') }}</label>
                            <select multiple name="genre_ids[]" class="form-control {{ $errors->has('genre_ids') ? 'has-error' : '' }}">
                            @foreach ($genres as $genre)
                                <option value="{{$genre->id}}" {{ in_array($genre->id, $video->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{$genre->name}}
                                </option>
                            @endforeach
                            </select>
                            @if ($errors->has('genre_ids'))
                            <span class="text-danger">{{ $errors->first('genre_ids') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('/videos') }}" type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">{{ __('form.back') }}</a>
                        <input type="submit" class="btn btn-success" value="{{ __('form.submit') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
