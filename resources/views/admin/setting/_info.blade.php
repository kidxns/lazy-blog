<div class="row">
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header h6 shadow-none">Account</div>
            <div class="card-body">
                <form action="{{ route('setting.update', Auth::user() -> id)}}" id="form-setting-account">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="fz-14">Full Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name ?? '' }}"/>
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

                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="fz-14">Email*</label>
                            <input id="email" type="email" class="form-control"  name="email" value="{{ Auth::user()->email ?? '' }}" required autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label for="email" class="fz-14">Roles*</label>
                                    @foreach (Auth::user()->roles as $role)
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" value="{{ $role -> id }}" checked>
                                        <label class="form-check-label fz-13">
                                          {{ $role -> name }}
                                        </label>
                                      </div>
                                    @endforeach
                            </div>

                            <hr/>
                            <div class="form-group">
                                <label class="font-weight-bold fz-14">Delete account</label>
                                <div class="d-flex bd-highlight">
                                    <div class="pt-2 flex-grow-1 fz-12">By deleting your account you will close all your data</div>

                                    <div class="p-2 bd-highlight fz-13">
                                        <a href="javascript:function() { return false; }" class="bnt-delete-account"
                                        data-action="{{ route('setting.destroy', Auth::user()->id ?? '') }}"
                                        data-name="{{Auth::user()->name ?? '' }}"
                                        >Delete account</a>
                                    </div>
                                  </div>
                            </div>
                            <hr/>

                            <div class="form-group mt-5 text-right">
                                <input type="button" class="btn btn-primary form-control bnt-setting-account w-25" value="Save Changes" />
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>
