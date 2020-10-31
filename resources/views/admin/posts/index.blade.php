@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center shadow-none border-bottom-0">
                <div class="row w-100">
                    <div class="col-xl-6">
                        <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary">Create new blog</a>
                    </div>
                    <div class="col-xl-6 col-12">
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
            </div>

            <div class="card-body">
                {{-- Post List --}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="sorting h6" width='5%' data-order-type="desc" data-column-name="id">#<i id="id_icon" class="ml-2"></i>
                                </th>
                                <th class="sorting h6" width='20%' data-order-type="desc" data-column-name="title">
                                    Title<i id="title_icon" class="ml-2"></i>
                                </th>
                                <th class="sorting h6" width='15%' data-order-type="desc" data-column-name="category_id">
                                    Category<i id="category_id_icon" class="ml-2"></i>
                                </th>
                                <th class="sorting h6" width='15%' data-order-type="desc" data-column-name="author_id">Author<i id="author_id_icon" class="ml-2"></i>
                                </th>
                                <th class="sorting h6" width='15%' data-order-type="desc" data-column-name="posted_at">
                                    Date<i id="posted_at_icon" class="ml-2"></i>
                                </th>
                                <th class="sorting h6" width='15%' data-order-type="desc" data-column-name="status">
                                    Status<i id="status_icon" class="ml-2"></i>
                                </th>
                                <th class="h6" width='5%'>
                                    <i class="fas fa-comment"></i>
                                </th>

                            </tr>
                        </thead>
                        <tbody class="post-list">
                            @include('admin.posts._list')
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- End Card-Body --}}

                {{-- Show more --}}
            <div class="card-footer">
                <div class="row justify-content-end">
                    <div class="col-xl-1 col-12 form-group">
                        <select class="form-control fz-11" id="select-show-more">
                            <option selected hidden disabled>More</option>
                            <option value="10" class="fz-12">20</option>
                            <option value="40" class="fz-12">50</option>
                            <option value="60" class="fz-12">70</option>

                        </select>
                    </div>
                </div>
            </div>

        {{-- End Card-Footer --}}

        </div>
    </div>
    <input id="pagination-post" data-pagination="50" data-current-page="1" data-column="id" data-sort-type="desc" hidden>
</div>

<script type="module" src="js/admin/posts/index.js"></script>
</body>
@endsection
