@extends('layouts.app')
@section('main')
@include('layouts.nav')
<link rel="stylesheet" href="css/mdb.min.css">
<script src="js/public/posts/index.js" type="module"></script>
<div class="container-fluid p-5" style="margin-top: 100px">
    {{-- Search Bar --}}
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="md-form mt-0">
                <input class="form-control search-bar" type="text" placeholder="Search" aria-label="Search">
            </div>
        </div>


        <div class="col-12 col-lg-6">
            <div class="row justify-content-end">

                {{-- Category Filter --}}
                <div class="col-xl-4 col-12 d-flex d-flex flex-column">
                    <label class="fz-11">Categories</label>
                    <select id="filter-by-category" class="form-control fz-13">
                        <option>Sort By Category</option>
                        @foreach($posts->unique('category_id')?? '' as $post)
                        <option value="{{ $post->category->id ?? '' }}">{{ $post->category->categories ??'' }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Category Filter --}}
                <div class="col-xl-4 col-12 d-flex d-flex flex-column">
                    <label class="fz-11">Authors</label>
                    <select id="filter-by-author" class="form-control fz-13">
                        <option>Sort by Author</option>
                        @foreach($posts->unique('author_id') ?? '' as $post)
                        <option value="{{ $post->author->id ?? '' }}">{{ $post->author->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>



    {{-- Collection --}}
    <div class="row post-list">
        @include('posts._collection')

        {{-- Pagination --}}

    </div>
    <input id="posts-pagination" data-pagination="30" data-current-page="1" data-column="id" data-sort-type="desc" hidden>
    @endsection
