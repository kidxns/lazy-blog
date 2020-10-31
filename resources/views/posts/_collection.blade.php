@foreach($posts ?? '' as $item)
<div class="col-lg-6 col-12 mt-5 animated fadeInUp">
    <div class="card" style="height: auto">
        <div class="row no-gutters">

            {{-- Thumbnail --}}
            <div class="col-sm-5 d-flex align-lg-self-center">
                <img src="{{ $item->getThumb->getFirstMediaUrl('blog', 'square') }}" class="img-thumb">
            </div>
            {{-- Content --}}
            <div class="col-sm-7">
                <div class="card-body pb-0">
                    <h5 class="text-title mt-n1 pb-1"><a class='post' href="{{ route('post.show', $item->slug)}}">{{ $item -> title }}</a></h4>
                        <ul class="list-inline pb-0 mb-auto">
                            <li class="list-inline-item text-uppercase fz-12">
                                By {{ $item->author->name }}
                            </li>
                            <li class="list-inline-item text-uppercase fz-12">
                                On {{ $item -> created_at }}
                            </li>
                        </ul>
                        <p class="text-content p-0 m-0">
                            {{Illuminate\Support\Str::limit(strip_tags(preg_replace("/&#?[a-z0-9]{2,8};/i","",$item->content)),80)}}
                        </p>
                </div>
            </div>
            {{-- End Conent --}}

        </div>
    </div>
</div>
@endforeach

<div class="col-12 post-paginate">
    {!! $posts ?? '' ->link() !!}
</div>
