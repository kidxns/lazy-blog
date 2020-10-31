<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if(isset($user))
                                <form action="{{ route('users.update', $user->id ?? '')}}" id="form-update-user">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="name" class="fz-14">Username*</label>
                                                <input type="text" class="form-control" name="name" value="{{ $user -> name ?? '' }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="fz-14">Password*</label>
                                                <input type="password" class="form-control" name="password" value="{{ $user -> password }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="email" class="fz-14">Email*</label>
                                                <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" required autocomplete="email">
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="fz-14">Roles*</label>
                                                @include('admin.roles._list')
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm bnt-update-user">Save changes</button>
            </div>
        </div>
    </div>
</div>
