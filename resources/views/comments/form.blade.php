<form class="comment-form mb-5 gray-bg p-5" id="comment-form" action="{{ route('comment.store') }}">
    @csrf
    <div class="row">
        @if(!Auth::user())
        <div class="col-md-6">
            <div class="form-group">
                <input class="form-control bg-dark text-white-50" type="text" name="name" id="name" placeholder="Name:">
            </div>
        </div>
        @endif
        <div class="col-lg-12">
            <input name='post' value="{{ $post->id ?? '' }}"  id='post-id' hidden>
            <textarea class="form-control mb-3 bg-dark text-white-50" name="comment" id="comment" cols="30" rows="5" placeholder="Comment"></textarea>
        </div>


    </div>

    <button class="btn btn-primary bnt-comment" type="button"  value="Comment">
       Comment  <i class="fas fa-paper-plane ml-3"></i></button>
</form>
