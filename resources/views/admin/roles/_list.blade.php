@foreach (\App\Models\Role::all() as $role)
@if($user -> roles->first())
@foreach ($user -> roles ?? '' as $check)
<div class="form-check">
    <input class="form-check-input" type="radio" name="role" value="{{ $role -> id }}" {{ $check -> id === $role -> id ? 'checked' : '' }}>
    <label class="form-check-label fz-13">
        {{ $role -> name }}
    </label>
</div>
@endforeach
@else
<div class="form-check">
    <input class="form-check-input" type="radio" name="role" value="{{ $role -> id }}">
    <label class="form-check-label fz-13">
        {{ $role -> name }}
    </label>
</div>
@endif
@endforeach
