
@if($posts ?? '')
@foreach($posts ?? '' as $row)
<tr class="list-item animated fadeInUp">
    <td scope="row" class="vertical-align-middle">
        <div class="d-flex align-items-center inline">
            <input type="checkbox" id="{{$row -> id ?? ''}}" data-name="{{$row -> name ?? ''}}" value="{{$row -> id}}"
                class="category-checkbox">
            <label for="{{$row -> id ??' '}}"></label>
        </div>
    </td>

    <td class="vertical-align-middle text-capitalize text-primary">
        {{$row -> title ?? ''}}
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="admin/album" id="{{$row -> id}}" data-toggle="modal" data-target="#modal-view-album"
                    class="text-primary view-detail fz-12">Detail</a>
            </li>

            <li class="list-inline-item">
                <a href="{{  route('posts.edit' , $row -> id ?? '')}}" data-id="{{$row -> id}}" class="text-primary bnt-update fz-12">Edit</a>
            </li>
            <li class="list-inline-item">
                <a data-taget='#' data-id="{{$row -> id}}" data-name="{{$row->name ?? ''}}"  data-action="{{ route('posts.destroy', $row->id) }}"
                     class="text-primary bnt-remove-post fz-12">Delete</a>
            </li>
        </ul>
    </td>

    <td class="verticle text-capitalize fz-14">
        {{$row -> category -> categories ?? ''}}
    </td>



    <td class="vertical-align-middle text-capitalize fz-14">
        {{$row -> author -> name ?? ''}}
    </td>


    <td class="vertical-align-middle text-capitalize fz-14">
        {{ Carbon\Carbon::parse($row -> posted_at)->format('d  F  Y')}}
    </td>

    <td class="vertical-align-middle text-capitalize">
        {{$row -> status ?? ''}}
    </td>
    <td class="vertical-align-middle text-capitalize">
        {{count($row -> comments) ?? ''}}
    </td>
</tr>



@endforeach
<tr>
    <td colspan="8" class="posts-paginate">
        {!! $posts ?? '' -> links() !!}
    </td>
</tr>

@endif
