@push('scripts')
<script src="/assets/atwho/js/jquery.caret.min.js"></script>
<script src="/assets/atwho/js/jquery.atwho.min.js"></script>
<script>
/*
function startMention(data) {
    $('#commentarea').atwho({
        at: "@",
        headerTpl: '<div class="atwho-header">Member List<small>↑&nbsp;↓&nbsp;</small></div>',
        insertTpl: '[@${text}]',
        displayTpl: "<li>${text}</li>",
        limit: 10,
        data: data.results
    })
}
*/
</script>
<!-- <script type="application/javascript" src="{{ url('ajax/users?callback=startMention') }}"></script> -->
@endpush

@push('stylesheets')
<link href="/assets/atwho/css/jquery.atwho.min.css" rel="stylesheet">
@endpush




@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row" id="newcomment">

    <div class="col-sm-12">

        <form method="post" action="">
            {!! csrf_field() !!}
            <div class="form-group">
                <textarea required="required" class="form-control" rows="3" placeholder="{{ trans('common.add_a_comment') }}" id="commentarea" name="comment">{{ old('comment') }}</textarea>
                <span id="helpBlock" class="help-block">{{ trans('common.you_can_use_markdown') }}</span>
            </div>

            <button type="submit" class="btn btn-default pull-right">{{ trans('common.add_comment') }}</button>
        </form>


    </div>

</div>