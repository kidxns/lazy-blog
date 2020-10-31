
import { sendRequestAjax } from "../../ajax/index.js";
import { POST, DELETE } from "../../const/method.js";
import { pagination, destroy } from "../../helper/index.js";
const list = ".comments-list";
const url = "comment";
const paginate = "#comments-pagination";

$(document).on("click", ".bnt-comment", function() {
    const form = $(".comment-form");
    const data = form.serialize();
    const url = form.attr("action");
    const method = POST;
    sendRequestAjax(url, method, data, callback);
    function callback(res) {
        $(list).html("");
        $(list).html(res);
        form[0].reset();
    }
});

$(document).on("click", ".comments-paginate a", function(event) {
    event.preventDefault();
    pagination(null, this, url, paginate, list);
});

$(document).on("click", ".bnt-remove-comment", function(event) {
    event.preventDefault();
    const id = $('#post-id').val();
    const urlRemove = $(this).data("action");
    const view = id;
    destroy(urlRemove, "comment", callback);
    function callback() {
        pagination(view, null, url, paginate, list);
    }
});
