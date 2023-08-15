$(function () {
    setTimeout(checkNotifyVersionDashboard, 3000);
    setTimeout(checkStatusServer, 3000);
});

function checkNotifyVersionDashboard() {
    if ($('#update-version-dashboard-techres').text() === '1' && $('#important-dashboard-techres').text() === '1') {
        showNotifyVersionDashboard();
    }
}

function showNotifyVersionDashboard() {
    let title = 'Có bản cập nhật quan trọng ! Version: ' + $('#version-dashboard-techres').text(),
        content = $('#content-dashboard-techres').text() + '<br> Đây là bản cập nhật quan trọng, vui lòng đăng xuất !';
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: title,
        html: content,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Đăng xuất',
        cancelButtonText: 'Để sau',
        reverseButtons: true,
        focusConfirm: true
    }).then(async (result) => {
        if (result.value) {
            let method = 'get',
                url = 'logout',
                params = null,
                data = null;
            await axiosTemplate(method, url, params, data);
            location.reload(true);
        }
    })
}

function checkStatusServer() {
    if ($('#token-expiration-server').val() === '1') {
        let title = 'Phiên đăng nhập đã hết hạn',
            content = 'Vui lòng đăng xuất để tiếp tục sử dụng !';
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary btn-sweet-alert',
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: title,
            html: content,
            icon: 'warning',
            showCancelButton: false,
            confirmButtonText: 'Đăng xuất',
            reverseButtons: true,
            allowOutsideClick: false,
            focusConfirm: true
        }).then(async (result) => {
            if (result.value) {
                let method = 'get',
                    url = 'logout',
                    params = null,
                    data = null;
                await axiosTemplate(method, url, params, data);
                location.reload(true);
            }
        })
    }
}
