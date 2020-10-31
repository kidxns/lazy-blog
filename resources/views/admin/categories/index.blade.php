@extends('admin.index')
@section('content')
<script type="module" src="js/admin/categories/index.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-close">
                        </div>
                        <div class="card-header d-flex align-items-center shadow-none border-bottom-0">
                            <div class="row w-100">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="sorting h6" width='5%' data-sorting-type="desc" data-column-name="id">#<i id="id_icon" class="ml-2"></i>
                                            </th>
                                            <th class="sorting h6" width='20%' data-sorting-type="desc" data-column-name="name">
                                                Categories<i id="name_icon" class="ml-2"></i>
                                            </th>
                                            <th class="sorting h6" width='15%' data-sorting-type="desc" data-column-name="name">
                                                Created at<i id="name_icon" class="ml-2"></i>
                                            </th>
                                            <th colspan="2" class="sorting h6 text-center" width='15%' data-sorting-type="desc" data-column-name="fk_artist">Action<i id="fk_artist_icon" class="ml-2"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="categories-list">
                                        @include('admin.categories._list')
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-xl-2 col-12 form-group">
                                    <select class="form-control w-100 fz-11" id="select-show-more">
                                        <option selected hidden disabled>More</option>
                                        <option value="10" class="fz-12">20</option>
                                        <option value="40" class="fz-12">50</option>
                                        <option value="60" class="fz-12">70</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <input id="pagination-categories" data-pagination="50" data-current-page="1" data-column="id" data-sort-type="desc" hidden>

            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" id='form-new-category'>
                        @csrf
                        <div class="form-group">
                            <label for="my-input">Categories</label>
                            <input id="my-input" class="form-control" type="text" name="categories">
                            <button type="button" name="" id="" class="btn btn-primary mt-2 bnt-new-category">Submit</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Chart</h5>
                    @include('admin.categories.chart')
                </div>
            </div>
        </div>

    </div>
</div>
@include('admin.categories.edit')

@endsection
