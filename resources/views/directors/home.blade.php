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
<div class="container directors">
    <div class="col-md-10" style="margin-left:10px;display: flex; justify-content: flex-end">
        @can('modify')
        <a class="btn btn-small btn-primary btn-add" style="margin-bottom: 10px;" href="{{ url('/directors/create') }}">{{ __('form.director_create') }}</a>
        @endcan
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="padding:0px">
                    <h4 id="title">{{ __('form.director_title') }}</h4>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">{{ __('form.director_name') }}</th>
                            @can('modify')
                            <th style="text-align:center">{{ __('form.action') }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($directors as $director)
                        <tr>
                            <td style="text-align:center">{{$director->name}}</td>
                            @can('modify')
                            <td style="text-align:center;">
                                <a class="btn btn-small btn-info" href="{{ url('directors/edit/' . $director->id) }}">{{ __('form.edit') }}</a>
                                <form method="POST" action="/directors/destroy/{{$director->id}}" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <input type="submit" class="btn btn-small btn-danger" value="{{ __('form.delete') }}" onClick="return confirm('{{$info_delete}}')">
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td style="text-align:center"><b>{{ __('form.director_empty') }}</b></td>
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
