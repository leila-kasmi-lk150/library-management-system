$(document).ready(function() {
    $('#formValidation').validate({
        rules: {
            name_book: {
                required: true
            }
        },
        messages: {
            name_book: {
                required: 'Code user is required'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});