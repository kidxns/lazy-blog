@extends('admin.index')
@section('content')
<script type="module" src="js/admin/users/index.js"></script>
<div class="container-fluid">
    @include('admin.users.create')
    <div class="row">
        <div class="col-12 mt-5">
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
                                    <th class="sorting h6" width='5%' data-sorting-type="desc" data-column-name="id">#<i
                                            id="id_icon" class="ml-2"></i>
                                    </th>
                                    <th class="sorting h6" width='20%' data-sorting-type="desc" data-column-name="name">
                                        Name<i id="name_icon" class="ml-2"></i>
                                    </th>
                                    <th class="sorting h6" width='15%' data-sorting-type="desc" data-column-name="name">
                                        Email<i id="name_icon" class="ml-2"></i>
                                    </th>

                                    <th class="sorting h6" width='15%' data-sorting-type="desc" data-column-name="name">
                                        Roles<i id="name_icon" class="ml-2"></i>
                                    </th>

                                    <th class="sorting h6" width='15%' data-sorting-type="desc" data-column-name="name">
                                        Date<i id="name_icon" class="ml-2"></i>
                                    </th>


                                    <th colspan="2" class="sorting h6 text-center" width='15%' data-sorting-type="desc"
                                        data-column-name="fk_artist">Action<i id="fk_artist_icon" class="ml-2"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="users-list">
                                @include('admin.users._list')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input id="pagination-users" data-pagination="50" data-current-page="1" data-column="id"
            data-sort-type="desc" hidden>

    </div>
</div>
<div class="modal-edit-user">

</div>
@endsection
