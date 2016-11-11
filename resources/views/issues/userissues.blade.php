@extends('layout.master')

@section('content')

    <h1>{{ trans('common.users_issues', ['name' => $user->name]) }}</h1>

    @include('issues.partials.list')

@endsection