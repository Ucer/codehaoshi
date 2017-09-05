export function stack_error(response) {
    if ((typeof response.data.error !== 'string') && response.data.error) {
        toastr.error(response.data.error.message)
    } else if (typeof response.data == 'string') {
        toastr.error(response.status + ' ' + response.statusText)
    } else {
        let data = response.data;
        let errorcontent = '';

        Object.keys(data).map(function (key, index) {
            let value = data[key];

            errorcontent += '<span style="color: #e74c3c">' + value[0] + '</span><br>';
        });
        swal({
            title: "Error Text!",
            type: 'error',
            text: errorcontent,
            html: true
        });
    }
}