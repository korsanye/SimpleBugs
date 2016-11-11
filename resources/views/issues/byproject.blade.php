@extends('layout.master')

@section('content')


    @foreach ($projects as $project)
        <div class="row">
            <h5>{{ $project->name }}</h5>
            <p><sub>{{ count($project->issues) }} issue(s)</sub></p>
        </div>
        <div class="row">
            <table class="table table-striped small">
                <tbody>
                @foreach ($project->issues as $issue)
                    <tr>
                        <td><i class="fa {{ $issue->category->fa_icon }}" aria-hidden="true" title="{{ $issue->category->name }}"></i></td>
                        <td><a href="{{ url('issue/' . $issue->id ) }}">#{{ $issue->id }}</a></td>
                        <td><a href="{{ url('issue/' . $issue->id ) }}">{{ $issue->title }}</a></td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

@endsection