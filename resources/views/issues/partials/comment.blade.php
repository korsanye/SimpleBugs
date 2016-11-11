@inject('markdown', '\Michelf\MarkdownExtra')

<div class="row">
    <div class="col-sm-12">
        <hr>
    </div>
</div>


<div class="row" id="comment_{{ $post->id }}">
    <div class="col-md-12">

       <h6>

           @if ($post->user->trashed())
               <del>{{ $post->user->name }}</del>
           @else
           <img src="{{ gravatar($post->user->email, 15) }}" class="img-circle">
           <a href="{{ url('user/'.$post->user->id) }}">{{ $post->user->name }}</a>
           @endif
           <small>({{ $post->created_at->toDateTimeString() }})</small>
       </h6>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        {!! $markdown->transform($post->content) !!}

    </div>
</div>
