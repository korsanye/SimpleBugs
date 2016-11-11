@extends('layout.master')

@section('content')

    <div class="row text-center">
        <h1>[403] {{ trans('common.unauthorized') }}</h1>
    </div>
    <div class="row text-center">
        <p class="lead">{{ trans('common.missing_rights') }}</p>
        <p>
            {!! trans('common.how_about_looking_at_your_issues', ['link' => url('issues/mine')]) !!}
        </p>
    </div>

@endsection