<div class="row">
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header h6 shadow-none">Create new user</div>
            <div class="card-body">
                <form action="{{ route('users.store')}}" id="form-new-user">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="name" class="fz-14">Username*</label>
                                <input id="name" type="text" class="form-control" name="name"/>
                            </div>


                            <div class="form-group">
                                <label for="password" class="fz-14">Password*</label>
                                <input id="password" type="password" class="form-control" name="password"/>

                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="fz-14">Confirm Password*</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"/>
                            </div>




                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="email" class="fz-14">Email*</label>
                                <input id="email" type="email" class="form-control"  name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label for="email" class="fz-14">Roles*</label>
                                    @foreach (\App\Models\Role::all() as $role)
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" value="{{ $role -> id }}">
                                        <label class="form-check-label fz-13">
                                          {{ $role -> name }}
                                        </label>
                                      </div>
                                    @endforeach
                            </div>

                            <div class="form-group" style="margin-top: 2.3rem;">
                                <input type="button" class="btn btn-primary form-control bnt-create-user" value="Submit" />

                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="col-12 mt-3 animated fadeInUp">
            <ul class="list-group">
                @foreach($users ?? '' as $user)
                {{ $user->isOnline() }}
                @if($user->isOnline())
                    <li class="list-group-item d-flex justify-content-between align-items-center text-dark text-capitalize fz-13 border-0">
                        {{ $user -> name  }}
                        <kbd class="fz-12">Online</span>
                    </li>
                    <hr />
                @endif
                @endforeach
            </ul>
        </div>

    </div>
    </div>
