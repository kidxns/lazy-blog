@extends('admin.index')
@section('content')
<script src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea'
        , height: 700, // change this value according to your HTML
        plugins: 'image fullscreen autolink link'
        , toolbar: 'insertfile undo redo fullscreen | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image'
        , setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })

</script>

{{-- Post Form --}}
<form id="form-new-blog" action="{{ route('posts.store') }}">
    @csrf
    <div class="row">
        <div class="col-xl-8 col-12">
            {{-- title --}}
            <div class="form-group">
                <label for="my-input" class="h6">Title</label>
                <input class="form-control" name="title" id="title" />
            </div>

            {{-- Content --}}
            <div class="form-group">
                <label for="my-input" class="h6">Content</label>
                <textarea id="content" class="form-control" type="text" rows="3" name="content"></textarea>
            </div>
        </div>


        <div class="col-xl-4 col-12 mt-4">

            {{-- Upload img --}}
            <ul class="list-unstyled">
                <li class="list-group-item pt-3 pb-3">
                    <a class="fz-14 text-gray-800 tab-media">
                        <i class="fas fa-chevron-right mr-2"></i> Upload Image
                    </a>
                </li>

                {{-- Thumb --}}
                <li class="list-group-item pt-3 pb-3">
                    <a class="fz-14 text-gray-800 tab-thumb" data-toggle="collapse" href="#collapseMedia" role="button" aria-expanded="false" aria-controls="collapseMedia">
                        <i class="fas fa-chevron-right mr-2"></i> Thumb
                        <input id="thumb-id" type="hidden" name="thumb_id" value="">
                    </a>
                    <div class="collapse mt-3" id="collapseMedia">
                        <div class="row thumb-list">

                        </div>
                    </div>
                </li>

                 {{-- Category --}}

                <li class="list-group-item pt-3 pb-3">
                    <a class="fz-14 text-gray-800">
                        <i class="fas fa-chevron-down mr-2"></i> Categories
                    </a>
                    <div class="mt-3" id="collapseCatgory">
                        <select name="category_id" id="option-category" class="form-control">
                            @foreach (\App\Models\Category::orderBy('id', 'desc')->get() as $category)
                            <option value="{{ $category->id }}">{{ $category->categories }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

                {{-- Status --}}
                <li class="list-group-item pt-3 pb-3">
                    <a class="fz-14 text-gray-800">
                        <i class="fas fa-chevron-down mr-2"></i> Status
                    </a>
                    <div id="collapseStatus">
                        <input class="form-control" type="text" name="status" id="status" />
                    </div>
                </li>

                {{-- Date --}}
                <li class="list-group-item pt-3 pb-3">
                    <a class="fz-14 text-gray-800">
                        <i class="fas fa-chevron-down mr-2"></i> Date
                    </a>
                    <div id="collapseDate">
                        <input class='form-control' type="date" name="posted_at" id="posted_at" />
                    </div>
                </li>
            </ul>
            <button type="button" class="btn btn-primary w-100 mt-3 bnt-post">Submit</button>
        </div>
    </div>
</form>
<input id='pagination-media' data-pagination="10" data-current-page="1" data-column="id" data-sort-type="desc" hidden />
@include('admin.media.modal')
<script type="module" src="js/admin/posts/index.js"></script>
@endsection
