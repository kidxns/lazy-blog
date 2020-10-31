@if(Count($categories) > 0 ?? '')
@foreach($categories ?? '' as $row)
<tr class="list-item animated fadeInUp">
    <td scope="row" class="vertical-align-middle">
        <div class="d-flex align-items-center inline">
            <input type="checkbox" id="{{$row -> id}}" data-name="{{$row -> name ?? ''}}" value="{{$row -> id ?? ''}}" class="album-checkbox">
            <label for="{{$row -> id ?? ''}}"></label>
        </div>
    </td>
    <td class="vertical-align-middle text-capitalize text-primary">
        {{$row -> categories ?? ''}}
    </td>

    <td class="vertical-align-middle text-capitalize fz-14">
        {{ Carbon\Carbon::parse($row -> posted_at)->format('d  F  Y')}}
    </td>

    <td class="vertical-align-middle text-center">
        <i class="far fa-edit text-info bnt-edit-category" data-toggle="modal" data-target="#edit-category" data-id="{{ $row ->id ?? '' }}" data-name="{{ $row -> categories ?? ''}}"></i>
    </td>
    <td class="vertical-align-middle text-center">
        <i class="far fa-times-circle text-danger bnt-remove-category" data-id="{{ $row ->id ?? '' }}" data-name="{{ $row -> categories ?? '' }}" data-action={{ route('categories.destroy',$row -> id ?? '') }}></i>
    </td>
</tr>

@endforeach
<tr>
    <td colspan="8" class="categories-paginate">
        {!! $categories -> links() !!}
    </td>
</tr>

@else
<tr>
    <td colspan="12">No Records</td>
</tr>
@endif
