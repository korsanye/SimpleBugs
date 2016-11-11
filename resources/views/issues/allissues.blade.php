@extends('layout.master')

@push('scripts')
<script src="/assets/datatables/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        //$('#issues').DataTable();
    } );
</script>
@endpush

@push('stylesheets')
<link href="/assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('common.all_open_issues') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-default btn-xs" href="#" role="button">Closed issues</a>
        </div>

    </div>

    @include('issues.partials.list')

@endsection