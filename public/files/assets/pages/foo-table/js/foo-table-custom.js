'use strict';
$(document).ready(function () {
    $('.table').footable({
        "paging": {
            "enabled": true,
            "size": 100
        },
        "sorting": {
            "enabled": false
        }
    });
});
