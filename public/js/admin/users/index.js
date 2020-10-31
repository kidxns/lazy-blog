
import { sendRequestAjax} from "../../ajax/index.js";
import { POST, GET, PUT} from '../../const/method.js';
import { success, error, pagination } from '../helper.js';
import { destroy , search} from '../helper.js';

const list = '.users-list';
const paginate = '#pagination-users';
const url = 'users';

$(document).on("click", ".bnt-create-user", function(e) {
    e.preventDefault();
    const form = $("#form-new-user");
    const data = form.serialize();
    const method = POST;
    const urlSave = form.attr("action");
    sendRequestAjax(urlSave, method, data, callback);
    function callback(res){
        console.log(res);
        $(list).html(res);
        success("Successfully!");
        form[0].reset();
    }
});


$(document).on('click', '.bnt-edit-user', function(e){
const urlEdit = $(this).data('action');
const data = {};
const method = GET;
const list = '.modal-edit-user';

sendRequestAjax(urlEdit, method, data, callback);
function callback(res){
    // console.log(res);
    $(list).html('');
    $(list).html(res);
    res ? $('#edit-user').modal('show') : error('Something went wrong!');
}

})


$(document).on('click', '.bnt-update-user', function(e){
    e.preventDefault();
    const form = $("#form-update-user");
    const urlUpdate = form.attr('action');
    const data = form.serialize();
    const method = PUT;
    sendRequestAjax(urlUpdate, method, data, callback );
    function callback(res){
        res.true ? $("#edit-user").modal("hide") : error(res.false);
                if (res.true) {
                    pagination(null, null, url, paginate, list, null);

                }
    }

});


$(document).on('click', '.bnt-remove-user', function(e){
    e.preventDefault();
    const urlRemove = $(this).data('action');
    const id = [];
    const name = $(this).data("name");
    id.push($(this).data("id"));
    destroy(urlRemove, id, name, callback);
    function callback(res) {
        if (res.true) {
            success(res.true);
            pagination(null, null, url, paginate, list, null);
        }
        if (res.false) {
            error(res.false);
        }
    }

});


    /*** User pagination */
$(document).on('click', '.users-paginate a', function(event) {
    event.preventDefault();
    pagination(null, this, url, paginate, list);
});



/** Search data */
$(document).on('keyup', '.ip-search', function (event) {
    event.preventDefault();
    const urlSearch = 'admin/' + url + '/fetch/search';
    const query = $(this).val();
    const data = {
        query : query
    }
    search(urlSearch, data, list);
});
