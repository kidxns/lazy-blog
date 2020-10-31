@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th class="sorting fz-14" width='5%' data-order-type="desc" data-column-name="id">#<i
                                            id="id_icon" class="ml-2"></i>
                                    </th>
                                    <th class="sorting fz-14" width='25%' data-order-type="desc" data-column-name="content">
                                        Content<i id="content_icon" class="ml-2"></i>
                                    </th>
                                    <th class="sorting fz-14" width='20%' data-order-type="desc" data-column-name="author_id">
                                        Owner<i id="author_id_icon" class="ml-2"></i>
                                    </th>
                                    <th class="sorting fz-14" width='20%' data-order-type="desc"
                                        data-column-name="post_id">Post<i id="post_id_icon" class="ml-2"></i>
                                    </th>
                                    <th class="sorting fz-14" width='20%' data-order-type="desc" data-column-name="created_at">
                                        On<i id="created_icon" class="ml-2"></i>
                                    </th>
                                    <th class="sorting fz-14" width='10%'>
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="comments-list">
                                @include('admin.comments._list')
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-end">
                        <div class="col-xl-2 col-12 form-group">
                            <select class="form-control fz-11" id="select-show-more">
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
        <input id="pagination-comments" data-pagination="50" data-current-page="1" data-column="id" data-sort-type="desc"
            hidden>

        <div class="col-xl-4 col-12">
            <div class="card border-left-warning shadow py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Comments</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ $comments ? count($comments) : '0' }}
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>

    <script type="module" src="js/admin/comments/index.js"></script>
</body>
@endsection
