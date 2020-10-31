import { success, sendRequestAjax} from "../helper.js";
import { PUT } from '../../const/method.js';


$(function() {
    const option = $('#option-category-update').val();
    $('#option-category').val(option);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

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



$(document).on('click', '.bnt-post-update', function(e) {
    e.preventDefault();
    const url = $('#form-update-post').attr('action');
    const data = $('#form-update-post').serialize();
    const method = PUT;
    sendRequestAjax(url, method, data, callback)
    function callback(res){
        Object.keys(res).map((key, value) => {
            if (res.success) {
                success("The post " + res.data.title + " already!" + "<br/> Updated at: " + res.data.updated_at);
            }
        });

    }
});


