@foreach ($media as $item)
<div class="col-4 p-1 img-hover">
    <img src="{{$item->getFirstMediaUrl('blog', 'thumb') ?? ''}}" data-thumb-id="{{ $item->id ?? ''  }}" class="img-thumbnail post-thumb set-thumbnail" />

</div>
@endforeach
