@if(Count($categories) > 0 ?? '')
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
<div class="row">
    <div class="col-12 fz-14">
        {!! $catgories ?? '' ?? '' -> links() !!}
    </div>
</div>

@else
<div class="row">
    <div class="col-12">No Data</div>
</div>
@endif
