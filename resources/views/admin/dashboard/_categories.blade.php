
    <div class="card shadow border-bottom-info">
            <div class="card-header py-3">
                <h6>Categories</h5>
            </div>
        <div class="card-body">
            <p class="card-text">
                @foreach($categories ?? '' as $row)
                <div class="row mt-2">
                    <div class="col-4 text-capitalize fz-14">
                        {{$row -> categories ?? ''}}
                    </div>

                    <div class="col-2 fz-14">
                        {{ count($row -> posts) ?? '' }}
                    </div>

                    <div class="col-4">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $pc = count($row ->posts) ===0 ? 0 : count($row ->posts) / count(\App\Models\Post::all())  *100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                {{ $pc.'%' }}
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                @endforeach
            </p>
        </div>
    </div>
