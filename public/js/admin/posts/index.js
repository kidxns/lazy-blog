import { error, success, customFileLabel, sendRequestAjax } from "../helper.js";
import { fetch_data, pagination, destroy } from "../helper.js";
import { search, sorting, filter} from "../helper.js";

import { POST } from "../../const/method.js";

const list = ".post-list";
const paginate = "#pagination-post";
const view = "admin.posts._list";
const url = "posts";

customFileLabel();

$(document).on('keyup', '.ip-search', function (event) {
    event.preventDefault();
    const urlSearch = 'admin/' + url + '/fetch/search';
    const query = $(this).val();
    const data = {
        query : query
    }
    search(urlSearch, data, list);


});

/** Post pagination */
$(document).on("click", ".posts-paginate a", function(event) {
    event.preventDefault();
    pagination(view, this, url, paginate, list);
});

/*** Sorting data */
$(document).on("click", ".sorting", function() {
    sorting(view, url, this, paginate, list);
});

/** Filter data by category */
$(document).on("change", "#filter-by-category", function(e) {
    const urlFilter = "admin/" + url + "/fetch/filter";
    const value = $(this).val();
    const data = {
        column: "category_id",
        data: value
    };
    filter(urlFilter, data, list);
});

/** Filter data by author */
$(document).on("change", "#filter-by-author", function(e) {
    const urlFilter = "admin/" + url + "/fetch/filter";
    const value = $(this).val();
    const data = {
        column: "author_id",
        data: value
    };
    filter(urlFilter, data, list);
});

/*** Create new post */
$(document).on("click", ".bnt-post", function(e) {
    e.preventDefault();
    $("#content").val(tinymce.activeEditor.getContent());
    const data = $("#form-new-blog").serialize();
    const urlSavePost = $("#form-new-blog").attr("action");
    const method = POST;

    sendRequestAjax(urlSavePost, method, data, callback);
    function callback(res) {
        Object.keys(res).map((key, value) => {
            if (res.success) {
                success("The post " + res.data.title + " already!");
            }
        });
    }
});

/*** Get images when click on tab thumb */
$(document).on("click", ".tab-thumb", function(e) {
    e.preventDefault();
    const view = "admin.media.thumb";
    const url = "media";
    const list = ".thumb-list";
    fetch_data(view, url, 1, "desc", "id", 8, list, callback);
    function callback(res) {
        $(list).html(res);
    }
});

/*** Remove the post */
$(document).on("click", ".bnt-remove-post", function(e) {
    e.preventDefault();
    const id = [];
    const name = $(this).data("name");
    const urlDelete = $(this).data("action");
    id.push($(this).data("id"));
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

/*** Set value when choose thumbnail */
$(document).on("click", ".post-thumb", function(e) {
    e.preventDefault();
    $(".post-thumb").removeClass("bg-success");
    const id = $(this).data("thumb-id");
    $("#thumb-id").val(id);
    $(this).addClass("bg-success");
});

/*** Cancle choose thumbnail when double click on thumb */
$(document).on("dblclick", ".post-thumb", function() {
    $(this).removeClass("bg-success");
    $("#thumb-id").val("");
});

/*** Collapse icon event click */
$(document).on("click", ".fa-chevron-right", function() {
    $(this).addClass("fa-chevron-down");
    $(this).removeClass("fa-chevron-right");
});
$(document).on("click", ".fa-chevron-down", function() {
    $(this).addClass("fa-chevron-right");
    $(this).removeClass("fa-chevron-down");
});
