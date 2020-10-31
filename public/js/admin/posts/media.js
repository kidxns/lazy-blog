import { progress } from "../../const/index.js";
import { pagination, destroy, error, success, customFileLabel } from "../helper.js";

const url = "media";
const paginate = "#pagination-media";
const list = ".media-list";
const view = "admin.media._list";


customFileLabel();


/*** Media pagination */
$(document).on("click", ".media-paginate a", function(event) {
    event.preventDefault();
    pagination(view, this, url, paginate, list);
});


/*** Upload media */
$(document).on("change", ".upload-media", function() {
    $(".form-group-upload").html("");
    $(".form-group-upload").html(progress);

    const form_data = new FormData();
    $('input[type="file"]').each(function() {
        const media = $("#input-upload-media").prop("files")[0];
        form_data.append("image", media);
        form_data.append("view", view);
    });

    $.ajax({
        url: $(this).data("action"),
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        data: form_data,
        success: function(result) {
            $(list).html("");
            $(list).html(result);
        },
        error: function(err) {
            const errors = err.responseJSON.errors;
            $.each(errors, function(index, value) {
                error(value);
            });
        }
    }).then(() => {
        $(".form-group-upload").html("");
    });
});


/*** Get media when click on tab media */
$(document).on("click", ".tab-media", function(e) {
    e.preventDefault();
    pagination(view, null, url, paginate, list, callback);
    function callback(res) {
        res ? $(".modal-media").modal("show") : error("Something went wrong");
    }
});


/*** Copy url when click images */
$(document).on("click", "#img-media", function(e) {
    e.preventDefault();
    let url = $(this).data("url");
    const setValue = $("#copy-url").attr("value", url);
    $("input#copy-url").select();
    document.execCommand("copy");
    $(".img-media").removeClass("bg-success");
    $(this).addClass("bg-success");
});


/*** Remove media */
$(document).on("dblclick", ".img-media", function() {
    const id = [];
    const name = $(this).data("name");
    const urlDelete = $(this).data("action");
    id.push($(this).data("media-id"));
    destroy(urlDelete, id, name, callback);
    function callback(res) {
        if (res.true) {
            success(res.true);
            pagination(view, null, url, paginate, list, null);
        }
        if (res.false) {
            error(res.false);
        }
    }
});


/*** Review thumbnail */
$(document).on("click", ".set-thumbnail", function(e) {
    e.preventDefault();
    const url = $(this).attr("src");
    $(".current-thumb").attr("src", url);
});
