<ul class="list-group">
    @foreach($posts->sortBy('view_count') -> take(6) ?? '' as $post)
    <a href="{{ route('post.show', $post->slug)}}">
        <li class="list-group-item d-flex justify-content-between align-items-center text-dark text-capitalize fz-13 border-0 animated fadeInUp">
            <div class="comment-area-box media">
                <img src="{{ $post->getThumb->getFirstMediaUrl('blog','thumb') }}" class="img-cover-thumb float-left mr-3 mt-2" width="65rem" height="65rem">
                <div class="comments d-flex flex-column bd-highlight">
                    <div class="comment-body pl-2 pr-5 pt-1 pb-1 ml-4 bd-highlight">
                        <p class="mb-0 text-capitalize fz-15 font-weight-bold">
                            <a class='post small' href="{{ route('post.show', $post->slug)}}">{{ $post -> title }}</a>
                        </p>
                        <div class="comment-content ">
                            <p class="m-0">{{ $post -> created_at }}</p>
                        </div>
                    </div>
                    <span class="date-comm fz-12 text-capitalize text-black-50 bd-highlight pl-3 mt-1">
                    </span>
                </div>
            </div>
        </li>
        <hr />
    </a>
    @endforeach
</ul>
