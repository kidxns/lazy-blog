@extends('layouts.app')
@include('layouts.nav')
@section('main')

<div class="container-fluid" style="margin-top: 100px">
    <div class="row">
        <div class="col-lg-2 d-none d-sm-block">
        </div>
        <div class="col-md-8 col-12">
            <div class="container">

                {{-- Post Content --}}
                <div class="single-post">
                    <div class="post-header mb-5 text-center">
                        <div class="meta-cat">
                            <a class="post-category font-extra text-color text-uppercase font-sm letter-spacing-1" href="javascript:()=>false">
                                <kbd>{{ $post -> category->categories ?? '' }}</kbd>
                                <kbd>{{ $post -> status ?? '' }}</kbd>
                            </a>
                        </div>
                        {{-- Post title --}}
                        <h2 class="post-title mt-2">
                            {{ $post ->title ?? ''}}
                        </h2>

                        <div class="post-meta mt-5">
                            <span class="text-uppercase font-sm letter-spacing-1 mr-3 fz-14">by {{ $post -> author -> name ?? ''}}</span>
                            <span class="text-uppercase font-sm letter-spacing-1 mr-3 fz-14">{{ $post -> created_at->format('M d yy') }}</span>
                            <span class="text-uppercase font-sm letter-spacing-1 fz-14"><i class="fas fa-comment"></i> {{ count($post->comments) }}</span>
                        </div>
                        <div class="post-featured-image mt-5 d-flex justify-center mt-5 view overlay">
                            <img src="{{ $post->getThumb->getFirstMediaUrl('blog', 'square') }}" class="img-cover-post w-100 mask waves-effect waves-light rgba-white-slight" alt="featured-image">
                        </div>
                    </div>
                    <div class="post-body">
                        {{-- Content --}}
                        <div class="entry-content">
                            {!! $post -> content ?? '' !!}
                        </div>

                        {{-- Tags --}}
                        <div class="post-tags py-4">
                            <a href="#">#Devblog</a>
                            <a href="#">#Game</a>
                            <a href="#">#it</a>
                        </div>

                    </div>
                </div>

                <hr />

                {{-- Related Post --}}
                <div class="related-posts-block mt-5">
                    <h5 class="news-title mb-4 text-right text-uppercase">
                        <kbd>You May Also Like</kbd>
                    </h5>

                    <div class="row">
                        @foreach($also as $like)
                        <div class="col-lg-4 col-sm-6 shadow-sm also-like-post">
                            <div class="post-block-wrapper mb-4 mb-lg-0 pt-2">
                                <img class="also-like-thumb w-100 " src="{{ $like->getThumb->getFirstMediaUrl('blog','thumb') }}" />
                                <div class="post-content mt-3">
                                    <h5>
                                        <a href="{{ route('post.show', $like->slug)}}" class="fz-15 text-dark">
                                            {{ $like -> title }}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                    {{-- End Related Post --}}
                </div>

                <hr class="mt-5" />

                    {{-- Comments --}}
                <div class="comment-area my-5">
                    <div class="comment-area-box media mt-5">
                        {{-- Comment list --}}
                        <div class="row comments-list">
                            @include('comments._list')
                        </div>

                        <input id="comments-pagination" data-pagination="10" data-current-page="1" data-column="id" data-sort-type="desc" hidden>
                        <div class="comments-paginate mt-5">
                            {!! $comments ?? '' -> link() !!}
                        </div>
                    </div>

                    {{-- Comment Form --}}
                    @include('comments.form')

                </div>


                <script src="js/public/comments/index.js" type="module"></script>
            </div>
            <div class="col-md-2 d-none d-sm-block">

            </div>
        </div>
    </div>
    @include('layouts.confirm')
    @include('layouts.error')
    @include('layouts.sucess')
    @endsection
