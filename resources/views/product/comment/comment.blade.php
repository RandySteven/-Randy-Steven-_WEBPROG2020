@foreach ($comments as $comment)
<div>
    <div class="container my-2">
        <img src="{{ $comment->user->gravatar() }}" width="25" class="rounded rounded-circle" alt="">
        <strong>{{ $comment->user->name }}</strong>
        <p>{!! nl2br($comment->comment) !!}</p>

    <div class="container">
        <form action="{{ route('reply') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product_id }}">
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <input type="text" name="comment" id="" class="form-control" placeholder="Reply to {{ $comment->user->name }}">
        </form>
    </div>
    </div>
    <div class="container">
        @include('product.comment.comment', ['comments'=>$comment->replies])
    </div>
</div>
@endforeach
