function checkUserMasterKey(master_key = '', route = '') {
    // var is_valid_master_key = false
    return $.ajax({
        url: route,
        type: "post",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            master_key: master_key
        },
        success: function (response) {
            // is_valid_master_key = true
            // return is_valid_master_key
        }, error: function (response) {
        },
    })

    // return is_valid_master_key;
}

function getResponse(response) {
    var is_valid_master_key = false
    if (response.success) {
        is_valid_master_key = true
    }
    return is_valid_master_key
}