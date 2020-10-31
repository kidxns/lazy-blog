import { pagination, sendRequestAjax, destroy, error, success } from "../helper.js";
import { search } from "../helper.js";
import { PUT, POST } from '../../const/method.js';


const list = ".categories-list";
const url = "categories";
const paginate = "#pagination-categories";
const view = "admin.categories._list";
const csrf = $('meta[name="csrf-token"]').attr("content");


/*** Search */
$(document).on('keyup', '.ip-search', function (event) {
    event.preventDefault();
    const urlSearch = 'admin/' + url + '/fetch/search';
    const query = $(this).val();
    const data = {
        query : query
    }
    search(urlSearch, data, list);
});


/*** Categories pagination */
$(document).on("click", ".categories-paginate a", function(event) {
    event.preventDefault();
    pagination(view, this, url, paginate, list);
});



/*** Create new category */
$(document).on("click", ".bnt-new-category", function(e) {
    e.preventDefault();
    const form = $("#form-new-category");
    const method = POST;
    const data = form.serialize();
    const urlSaveCategory  = form.attr("action");
    sendRequestAjax(urlSaveCategory, method, data, callback);
    function callback(res){
            $(list).html(res);
            success("Successfully!");
            form[0].reset();
    }

});


/*** Remove category */
$(document).on("click", ".bnt-remove-category", function(e) {
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


/*** Edit category */
$(document).on("click", ".bnt-edit-category", function() {
    const urlEdit = $("#form-edit-category").attr("action");
    const id = $(this).data("id");
    const name = $(this).data("name");
    $("#input-edit-category").attr("value", name);
    $(".bnt-saveChange").off('click').on("click",function(e) {
        e.preventDefault();
        const category = $("#input-edit-category").val();
        const method = PUT;
        const data = {
            id: id,
            categories: category,
            _token: csrf
        };

        sendRequestAjax(urlEdit, method, data, callback);
        function callback(res){
            console.log(res);
                res.true ? $("#edit-category").modal("hide") : error(res.false);
                if (res.true) {
                    pagination(view, null, url, paginate, list, null);

                }
        }
    });
});
