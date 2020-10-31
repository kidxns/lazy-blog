@foreach($comments as $comment)
<div class="col-12 mt-3 animated fadeInUp">
    <div class="comment-area-box media">
        <img alt="" src="img/logo.jpg" class="img-thumbnail rounded-circle float-left mr-3 mt-2" width="65rem" height="65rem">
        <div class="comments d-flex flex-column bd-highlight">
            <div class="comment-body pl-2 pr-5 pt-1 pb-1 ml-4 bd-highlight">
                <h6 class="mb-0 text-capitalize fz-15 font-weight-bold">{{ $comment->author -> name ?? $comment->name }} </h6>
                <div class="comment-content ">
                    <p class="m-0">{{ $comment -> content }}</p>
                </div>
            </div>

            <span class="date-comm fz-12 text-capitalize text-black-50 bd-highlight pl-3 mt-1">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <i class="ti-time mr-2"></i>{{ $comment -> created_at -> diffForHumans()  }}
                    </li>
                    @if(Auth::user())
                    @if($comment->author_id ?? '' === Auth::user()->id)
                    <li class="list-inline-item">
                        <a href="script:()=>false" class="text-primary bnt-edit-comment fz-12">Edit</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="script:()=>false" class="text-primary bnt-remove-comment fz-12" data-action="{{route('comment.destroy', $comment->id ?? '')}}">Remove</a>
                    </li>
                    @endif
                    @endif

                </ul>
            </span>
        </div>
    </div>
</div>
@endforeach
