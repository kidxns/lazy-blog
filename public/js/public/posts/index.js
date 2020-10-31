import { pagination } from '../../helper/index.js';
import { search , filter} from '../../helper/index.js';


const list = ".post-list";
const paginate = "#posts-pagination";
const url = "posts";

$(document).on("click", ".post-paginate a", function(event) {
    event.preventDefault();
    pagination(null, this, url, paginate, list);
});


$(document).on('keyup', '.search-bar', function (event) {
    event.preventDefault();
    const urlSearch = url + '/fetch/search';
    const query = $(this).val();
    const data = {
        query : query
    }
    search(urlSearch, data, list);


});

/** Filter data by category */
$(document).on("change", "#filter-by-category", function(e) {
    const urlFilter = url + "/fetch/filter";
    const value = $(this).val();
    const data = {
        column: "category_id",
        data: value
    };
    filter(urlFilter, data, list);
});



/** Filter data by author */
$(document).on("change", "#filter-by-author", function(e) {
    const urlFilter = url + "/fetch/filter";
    const value = $(this).val();
    const data = {
        column: "author_id",
        data: value
    };
    filter(urlFilter, data, list);
});
