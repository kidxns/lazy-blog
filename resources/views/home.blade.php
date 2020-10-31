@extends('layouts.app')
@section('main')
<link href="css/mdb.min.css" rel="stylesheet">
<link href="css/home.css" rel="stylesheet">
<script src="js/mdb.min.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @include('layouts.nav')
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="row pl-lg-5 pr-lg5" style="margin-top: 100px">
                    <div class="col-12 animated fadeInDown">

                        {{-- BANNER --}}
                        <div class="card">
                            <div class="view overlay">
                                <img src="{{Arr::first ($posts) -> getThumb -> getFirstMediaUrl('blog', 'square')}}" class="img-cover" alt="photo">
                                <a href="#">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!--Card content-->
                            <div class="card-body">
                                <kbd class="small">{{Arr::first ($posts) -> category -> categories}}</kbd>
                                <h4 class="card-title mt-2"><a class='post' href="{{ route('post.show', Arr::first ($posts)->slug)}}">{{ Arr::first ($posts)->title }}</a></h4>
                                <ul class="list-inline pb-0">
                                    <li class="list-inline-item text-uppercase fz-13">
                                        {{Arr::first ($posts) -> author -> name}}
                                    </li>
                                    <li class="list-inline-item text-uppercase fz-13">
                                        On {{Arr::first ($posts) -> created_at}}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- End Banner --}}
                    </div>

                    {{-- Latest Stories --}}
                    <div class="col-12">
                        <button class="bnt border-title btn-lg radius-0 fz-15 w-100 text-uppercase mt-5">
                            Latest Stories
                        </button>
                    </div>
                    @include('posts._list')
                    {{-- End Last Store --}}

                </div>
            </div>
            <div class="col-lg-4 col-12 d-lg-block d-sm-none" style="margin-top: 100px">
                {{-- Popular --}}
                <button class="bnt border-title btn-lg radius-0 fz-15 w-100">
                    Popular
                </button>
                <div class="row">
                    <div class="col-12 mt-3">
                        @include('posts.popular')
                    </div>
                </div>

                {{-- Categories --}}
                <button class="bnt border-title btn-lg radius-0 fz-15 w-100 mt-5">
                    Categories
                </button>
                <div class="row">
                    @include('categories._list')
                </div>

                {{-- Comment --}}
                <button class="bnt border-title btn-lg radius-0 fz-15 w-100">
                    Comments
                </button>
                <div class="row">
                    @include('comments._list')
                </div>
            </div>

        </div>
    </div>


    <script src="js/scrolling-nav.js"></script>


    @endsection
