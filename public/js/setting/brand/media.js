$(function () {
    $('#search-folder-setting-brand').on('keyup', function () {
        let g = removeVietnameseStringLowerCase($(this).val());
        $("#data-folder-setting-brand .name-folder-setting-brand").each(function () {
            let s = $(this).text().toLowerCase();
            $(this).closest('.item-folder-setting-brand')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });
    $('#create-folder-setting-brand').on('click', function () {

        $('#data-folder-setting-brand').prepend(`<div class="col-4 item-folder-setting-brand">
                <div class="card-block2 card card-border-default">
                    <div class="job-cards">
                        <div class="media" style="padding-top: 10px;">
                            <a class="media-left media-middle" href="#">
                                <img src="images/folder-icon.webp" style="width: auto; height: 60px">
                            </a>
                            <div class="media-body">
                                <div class="company-name m-b-10">
                                    <input style="font-size: 24px; font-weight: bold" class="name-folder-setting-brand" value="noti162253951473....">
                                    <i class="text-muted f-14">December 16, 2017</i></div>
                            </div>
                            <div class="media-right" style="top: 0; right: 5px">
                                <i class="ti-more-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`);
    });
    $('.item-folder-setting-brand:eq(0) input').select();
    $('#create-media-setting-brand').on('click', function () {
        $('#modal-create-media-setting-brand').modal('show');
    });
    $(document).on('dblclick', '.item-folder-setting-brand', function () {
        $('#div-folder-setting-brand').addClass('d-none');
        $('#div-media-setting-brand').removeClass('d-none');
    })
})
