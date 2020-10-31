@if($comments ?? '')
@foreach($comments ?? '' as $comment)
<tr class="list-item animated fadeInUp">
    <td scope="row" class="vertical-align-middle">
        <div class="d-flex align-items-center inline">
            <input type="checkbox" id="{{$comment -> id}}" data-name="{{$comment -> name ?? ''}}" value="{{$comment -> id}}"
                class="comment-checkbox">
            <label for="{{$comment -> id}}"></label>
        </div>
    </td>

    <td class="vertical-align-middle text-capitalize fz-14">
        {{$comment -> content ?? ''}}
    </td>

    <td class="vertical-align-middle text-capitalize fz-14">
        {{$comment -> author -> name ?? ''}}
    </td>


    <td class="verticle text-capitalize fz-14">
        <a href="{{ route('posts.show', $comment -> post_id ?? '') }}">
            {{$comment -> post -> title ?? ''}}
        </a>

    </td>


    <td class="vertical-align-middle text-capitalize fz-14">
      {{ $comment -> created_at ?? '' }}
    </td>

    <td class="vertical-align-middle text-capitalize text-center">
        <i class="fas fa-times text-danger bnt-remove-comment" data-name="{{ $comment -> content ?? '' }}" data-action="{{ route('comments.destroy', $comment -> id ?? '') }}"></i>
    </td>

</tr>



@endforeach
<tr>
    <td colspan="8" class="comments-paginate">
        {!! $comments ?? '' -> links() !!}
    </td>
</tr>

@endif
