<div class="modal fade modal-media" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- modal-header --}}
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Media</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            {{-- end modal-header --}}
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group-prepend">
                        <div class="custom-file mt-2">
                            <input type="file" class="custom-file-input form-control-sm upload-media" id="input-upload-media" data-action='{{ route('media.store') }}'>
                            <label class="custom-file-label" for="customFile"></label>
                            <div class='form-group-upload mt-3'></div>
                        </div>
                    </div>
                </div>
             {{-- end modal-body --}}

                <div class="form-group">
                    <input type="text" id="copy-url" class="form-control-sm border-secondary" value="">
                </div>
                <div class="media-list row">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module" src="js/admin/posts/media.js"></script>
