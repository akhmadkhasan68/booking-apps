function submitForm(url, method, data, redirect) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response)
            if(response.success) {
                toastr.success(response.message);

                setTimeout(function() {
                    window.location.href = redirect;
                }, 1000);

            }
        },
        error: function(response) {
            const responseJSON = response.responseJSON;
            if(!responseJSON.success) {
                const errors = responseJSON.message;
                //check errors is objects
                if(typeof errors === 'object') {
                    for(const key in errors) {
                        toastr.error(errors[key]);
                    }
                } else {
                    toastr.error(errors);
                }
            }
        }
    });
}
