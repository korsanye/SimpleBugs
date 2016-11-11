<div class="row">
    <table class="table table-striped small" id="issues">
        <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th>{{ trans('common.title') }}</th>
            <th>{{ trans('common.assignee') }}</th>
            <th>{{ trans('common.priority') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($issues as $issue)
            <tr>
                <td><i class="fa {{ $issue->category->fa_icon }}" aria-hidden="true" title="{{ $issue->category->name }}"></i></td>
                <td><a href="{{ url('issue/' . $issue->id ) }}">#{{ $issue->id }}</a></td>
                <td><a href="{{ url('issue/' . $issue->id ) }}">{{ $issue->title }}</a></td>
                <td><a href="{{ url('user/' . $issue->user->id ) }}">{{ $issue->user->name }}</a></td>
                <td>{{ $issue->priority->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
