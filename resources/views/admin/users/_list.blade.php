@if(Count($users) > 0 ?? '')
@foreach($users ?? '' as $item)
<tr class="list-item animated fadeInUp">
    <td scope="row" class="vertical-align-middle">
        <div class="d-flex align-items-center inline">
            <input type="checkbox" id="{{$item -> id}}" data-name="{{$item -> name ?? ''}}" value="{{$item -> id ?? ''}}" class="album-checkbox">
            <label for="{{$item -> id ?? ''}}"></label>
        </div>
    </td>
    <td class="vertical-align-middle text-capitalize text-primary">
        {{$item -> name ?? ''}}
    </td>

    <td class="vertical-align-middle fz-14">
        {{ $item -> email ?? '' }}
    </td>

    <td class="vertical-align-middle text-capitalize fz-14">
        @foreach ($item -> roles as $role)
        {{ $role -> name }}
        @endforeach
    </td>

    <td class="vertical-align-middle text-capitalize fz-14">
        {{ $item -> created_at ?? '' }}
    </td>

    <td class="vertical-align-middle text-center">
        <i class="far fa-edit text-info bnt-edit-user" data-id="{{ $item ->id ?? '' }}" data-action='{{ route('users.edit', $item -> id ?? '') }}'></i>
    </td>
    <td class="vertical-align-middle text-center">
        <i class="far fa-times-circle text-danger bnt-remove-user" data-id="{{ $item ->id ?? '' }}" data-name="{{ $item -> name ?? '' }}" data-action={{ route('users.destroy',$item -> id ?? '') }}></i>
    </td>
</tr>

@endforeach
<tr>
    <td colspan="8" class="users-paginate">
        {!! $users -> links() !!}
    </td>
</tr>

@else
<tr>
    <td colspan="12">No Records</td>
</tr>
@endif
