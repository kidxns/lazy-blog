
import { sendRequestAjax} from "../../ajax/index.js";
import { DELETE, PUT} from '../../const/method.js';
import { destroy, success} from '../helper.js';


$(document).on('click', '.bnt-setting-account', function(e){
    e.preventDefault();
    const form = $('#form-setting-account');
    const urlUpdate = form.attr('action');
    console.log(urlUpdate);
    const data = form.serialize();
    const method = PUT;
    sendRequestAjax(urlUpdate, method, data, callback );
    function callback(res){
        res.true ? $("#edit-user").modal("hide") : error(res.false);
        success(res.true);


    }

});


$(document).on('click', '.bnt-remove-account', function(e){

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
