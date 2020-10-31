import { DELETE, GET } from "../const/method.js";
import { sendRequestAjax } from "../ajax/index.js";
// import { method } from "lodash";

/***
 *
 * @view : string - blade will be receive the data return
 * @url :  string - url call to fetch data
 * @page : number - page number
 * @sort : string - desc or asc
 * @column :string - sort by column
 * @paginte : number -  total row in a table
 * @callback : function - callback data
 *
 */
function fetch_data(
    view,
    url,
    page,
    sort,
    column,
    paginate,
    list,
    callbackFetch,
    post
) {
    const data = {
        sort: sort,
        column: column,
        paginate: paginate,
        view: view
    };

    console.log(data);
    const urlRequest = url + "/fetch/data?page=" + page;
    const method = GET;
    sendRequestAjax(urlRequest, method, data, callback);
    function callback(res) {
        $(list).html("");
        $(list).html(res);
        return callbackFetch ? callbackFetch(res) : data;
    }
}

/***
 * @view : string blade will be receive the data return
 * @obj : object | null
 * @url :
 */

function pagination(view, obj, url, element, list, callback, id) {
    const paginate = $(element).data("pagination");
    let page;
    obj
        ? (page = $(obj)
              .attr("href")
              .split("page=")[1])
        : (page = $(element).attr("data-current-page"));
    $(element).attr("data-current-page", page);

    const column = $(element).data("column");
    const sort = $(element).data("sort-type");
    fetch_data(view, url, page, sort, column, paginate, list, callback, id);
}

/***
 * @url : string -  url call to destroy data
 * @id : number -  id object
 * @name: string | number | html - name object
 * @callback : callback data
 *
 */

function destroy(url,name, callbackDestroy) {
    const csrf = $('meta[name="csrf-token"]').attr("content");
    confirm("Do you want delete <b>" + name + "</b> ?");
    $(".bnt-confirm-agree")
        .off("click")
        .on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();
            const data = { _token: csrf };
            const method = DELETE;
            sendRequestAjax(url, method, data, callback);
            function callback(res) {
                $("#alert-confirm").modal("hide");
                return callbackDestroy(res);
            }
        });
}

/**
 * @customFileLabel
 * custom file label when upload file by input
 */
function customFileLabel() {
    $(".custom-file-input").on("change", function() {
        var fileName = $(this)
            .val()
            .split("\\")
            .pop();
        $(this)
            .siblings(".custom-file-label")
            .addClass("selected")
            .html(fileName);
    });
}

/**
 *
 * @param {*} view : blade receive data
 * @param {*} url : url
 * @param {*} obj : this
 * @param {*} paginateSelector : selector
 * @param {*} list : list
 */

function sorting(view, url, obj, paginateSelector, list) {
    const column = $(obj).data("column-name");
    const order = $(obj).data("order-type");
    const paginate = $(paginateSelector).data("pagination");
    let reverse = "";

    if (order === "asc") {
        $(obj).data("order-type", "desc");
        reverse = "desc";
        $("#" + column + "_icon").html(
            '<i class="fa fa-angle-up" aria-hidden="true"></i>'
        );
    }

    if (order === "desc") {
        $(obj).data("order-type", "asc");
        reverse = "asc";
        $("#" + column + "_icon").html(
            '<i class="fa fa-angle-down" aria-hidden="true"></i>'
        );
    }

    $(paginateSelector).data("column", column);
    $(paginateSelector).data("order-type", reverse);
    const page = $(paginateSelector).data("current-page");
    fetch_data(view, url, page, reverse, column, paginate, list);
}


/**
 *
 * @param {*} url : url request
 * @param {*} data : column & value
 * @param {*} list : show list
 */


function filter(url, data, list) {
    const method = GET;
    sendRequestAjax(url, method, data, callback);
    function callback(res) {
        $(list).html("");
        $(list).html(res);
    }
}

function search(url, data, list){
    const method = GET;
    sendRequestAjax(url, method, data, callback);
    function callback(res){
        $(list).html("");
        $(list).html(res);
    }
}

/**
 *
 * @param {*} content
 * sucess alert - content string | number | xml
 */
function success(content) {
    $(".content-success").html(content);
    $("#alert-success").modal("show");
    setTimeout(function() {
        $("#alert-success").modal("hide");
    }, 3000);
}

/**
 *
 * @param {*} content
 * sucess error - content string | number | xml
 */
function error(content) {
    $(".content-error").html(content);
    $("#alert-error").modal("show");
    setTimeout(function() {
        $("#alert-error").modal("hide");
    }, 3000);
}

/**
 *
 * @param {*} content
 * confirm - content string | number | xml
 */
function confirm(content) {
    $(".confirm-alert-content").html(content);
    $("#alert-confirm").modal("show");
    setTimeout(function() {
        $("#alert-confirm").modal("hide");
    }, 5000);
}

export {
    fetch_data,
    pagination,
    destroy,
    error,
    confirm,
    success,
    customFileLabel,
    sendRequestAjax,
    sorting,
    filter,
    search
};
