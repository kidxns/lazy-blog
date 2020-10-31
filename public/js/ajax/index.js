import { error } from "../admin/helper.js";

export const sendRequestAjax = function sendRequestAjax(
    url,
    method,
    data,
    callback
) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function (res) {
            return callback(res);
        },
        error: function (err) {
            let errors = err.responseJSON.errors;
            errors === undefined ? errors = err.responseJSON : errors;
            $.each(errors, function (index, value) {
                error(value);
            });
            error(errors.message);
        }
    });
};
