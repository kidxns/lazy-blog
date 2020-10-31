@foreach ($media as $item)
<div class="col-md-3 col-6 img-hover mt-2">
    <img src="{{$item->getFirstMediaUrl('blog', 'thumb') ?? ''}}" class="img-thumbnail img-media" data-action="{{ route('media.destroy', $item->id)}}" data-url="{{ $item->getMedia('blog')[0]->getUrl() ?? ''}}" data-name="{{ $item->getMedia('blog')[0]->name ?? ''}}" data-media-id="{{ $item->id ?? ''}}" id='img-media' data-toggle="tooltip" data-placement="top" title="Click to copy image" />

</div>
@endforeach
<div class="col-12 media-paginate">
    {!! $media -> links() !!}
</div>
