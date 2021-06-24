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
<div class="container stars">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="padding:0px">
                    <h4 id="title">{{ __('form.star_title') }}</h4>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">{{ __('form.star_name') }}</th>
                            @can('modify')
                            <th style="text-align:center">{{ __('form.action') }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center">{{$star->name}}</td>
                            @can('modify')
                            <td style="text-align:center;">
                                <a class="btn btn-small btn-info" href="{{ url('stars/edit/' . $star->id) }}">{{ __('form.edit') }}</a>
                                <form method="POST" action="/stars/destroy/{{$star->id}}" style="display: inline-block">
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
