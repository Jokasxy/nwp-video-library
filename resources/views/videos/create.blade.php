@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{ url('/videos/store') }}">
                    {{csrf_field()}}
                    <div class="modal-header" style="padding:0px">
                        <h4 id="title">{{ __('form.video_add') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('form.video_name') }}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <label>{{ __('form.video_description') }}</label>
                            <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{ old('description') }}">
                            @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                            <label>{{ __('form.video_image') }}</label>
                            <input type="text" name="image" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" value="{{ old('image') }}">
                            @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            <label>{{ __('form.video_director') }}</label>
                            <select name="director_id" class="form-control {{ $errors->has('director_id') ? 'has-error' : '' }}" value="{{ old('director_id') }}" >
                            @foreach ($directors as $director)
                                <option value="{{$director->id}}">{{$director->name}}</option>
                            @endforeach
                            </select>
                            <label>{{ __('form.video_stars') }}</label>
                            <select multiple name="star_ids[]" class="form-control {{ $errors->has('star_ids') ? 'has-error' : '' }}" value="{{ old('star_ids') }}" >
                            @foreach ($stars as $star)
                                <option value="{{$star->id}}">{{$star->name}}</option>
                            @endforeach
                            </select>
                            <label>{{ __('form.video_genres') }}</label>
                            <select multiple name="genre_ids[]" class="form-control {{ $errors->has('genre_ids') ? 'has-error' : '' }}" value="{{ old('genre_ids') }}" >
                            @foreach ($genres as $genre)
                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                            @endforeach
                            </select>
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
