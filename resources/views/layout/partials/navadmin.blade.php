<div class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>{{ trans('common.settings') }}</strong>
        </div>
        <div class=""panel-body>
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="{{ set_active('admin') }}"><a href="{{ url('admin') }}">{{ trans('common.dashboard') }}</a></li>
                <li role="presentation" class="{{ set_active('admin/user*') }}"><a href="{{ url('admin/users') }}">{{ trans('common.users') }}</a></li>
                <li role="presentation" class="{{ set_active('admin/project*') }}"><a href="{{ url('admin/projects') }}">{{ trans('common.projects') }}</a></li>
                <li role="presentation" class="{{ set_active('admin/categor*') }}"><a href="{{ url('admin/categories') }}">{{ trans('common.categories') }}</a></li>
                <li role="presentation" class="{{ set_active('admin/priorit*') }}"><a href="{{ url('admin/priorities') }}">{{ trans('common.priorities') }}</a></li>
                <li role="presentation" class="{{ set_active('admin/milestone*') }}"><a href="{{ url('admin/milestones') }}">{{ trans('common.milestones') }}</a></li>
            </ul>
        </div>
    </div>
</div>
