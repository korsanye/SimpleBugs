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

    <h1>{{ trans('common.search_results') }}</h1>

    @include('issues.partials.list')

@endsection