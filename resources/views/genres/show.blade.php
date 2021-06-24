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
<div class="container genres">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="padding:0px">
                    <h4 id="title">{{ __('form.genre_title') }}</h4>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">{{ __('form.genre_name') }}</th>
                            @can('modify')
                            <th style="text-align:center">{{ __('form.action') }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center">{{$genre->name}}</td>
                            @can('modify')
                            <td style="text-align:center;">
                                <a class="btn btn-small btn-info" href="{{ url('genres/edit/' . $genre->id) }}">{{ __('form.edit') }}</a>
                                <form method="POST" action="/genres/destroy/{{$genre->id}}" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <input type="submit" class="btn btn-small btn-danger" value="{{ __('form.delete') }}" onClick="return confirm('{{$info_delete}}')">
                                </form>
                            </td>
                            @endcan
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
