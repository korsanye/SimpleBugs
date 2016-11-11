@extends('layout.master')

@push('scripts')
<script src="/assets/select2/js/select2.min.js"></script>
<script>
    $('#inputNewCategory').select2({placeholder: "{{ trans('common.assign_to') }}"});
</script>
@endpush

@push('stylesheets')
<link href="/assets/select2/css/select2.min.css" rel="stylesheet">
@endpush


@section('content')

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('common.delete_category') }}</div>
                        <div class="panel-body">
                            <h3>{{ trans('common.confirm_deletion_category_header', ['name' => $category->name]) }}</h3>
                            <p>
                                {{ trans('common.confirm_deletion_category_text') }}
                            </p>
                            <p>
                                {{ trans_choice('common.confirm_deletion_category_text_second', count($category->issues), ['num' => count($category->issues)]) }}
                            </p>

                            <form method="post" action="">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="inputNewCategory">{{ trans('common.new_category') }}</label>
                                    <select name="new_category" class="form-control" id="inputNewCategory">
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"><i class="fa {{ $cat->fa_icon }}" aria-hidden="true"></i> {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-danger">{{ trans('common.confirm_delete_category') }}</button>
                            </form>


                        </div>

                    </div>



                </div>

            </div>




        </div>


    </div>

@endsection