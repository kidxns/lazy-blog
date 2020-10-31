import { destroy, success} from '../helper.js';
import { pagination, search, sorting} from '../helper.js';

const url = 'comments';
const list = '.comments-list';
const paginate = '#pagination-comments';
const view = 'admin.comments._list';

$(document).on('click', '.bnt-remove-comment', function(e){

    e.preventDefault();
    const urlRemove = $(this).data('action');
    const name = $(this).data('name')
    destroy(urlRemove, null, name, callback);
    function callback(){
        if (res.true) {
            success(res.true);
        }
        if (res.false) {
            error(res.false);
        }
    }

});


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
$(document).on("click", ".comments-paginate a", function(event) {
    event.preventDefault();
    pagination(view, this, url, paginate, list);
});


/*** Sorting data */
$(document).on("click", ".sorting", function() {
    sorting(view, url, this, paginate, list);
});
