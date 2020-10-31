@extends('admin.index')
@section('content')
<script src="js/admin/setting/index.js" type="module"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-8">
            @include('admin.setting._info')
        </div>
    </div>
</div>
@endsection
