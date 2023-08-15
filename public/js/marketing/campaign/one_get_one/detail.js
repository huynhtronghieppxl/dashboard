let idDetailOneGetOneCampaign;
function openModalDetailOneGetOneCampaign(r){
    idDetailOneGetOneCampaign = r.data('id');
    $('#modal-detail-one-get-one-campaign').modal('show');
    shortcut.add('ESC', function () {
        closeDetailOneGetOneMarketing();
    });
    getDataDetail();
}


async function getDataDetail(){
    let method = 'get',
        url = 'one-get-one-campaign.detail',
        params = {
            id:  idDetailOneGetOneCampaign,
        },
        body = {};
    let res = await axiosTemplate(method, url, params, body,[$('#modal-update-one-get-one-campaign')]);
    $('#thumbnail-detail-one-get-one-campaign').attr('src', res.data.data.banner_image_src);
    $('#name-update-one-get-one-campaign').text(res.data.data.name);
    // $('#branches-update-one-get-one-campaign').val(res.data.data.branches_id).trigger('change.select2');
    $('#time-from-detail-one-get-one-campaign').text(res.data.data.from_hour);
    $('#time-to-detail-one-get-one-campaign').text(res.data.data.to_hour);
    $('#date-from-detail-one-get-one-campaign').text(res.data.data.from_date);
    $('#date-to-detail-one-get-one-campaign').text(res.data.data.to_date);
    $('#date-apply-one-get-one-campaign').text(res.data.data.day_apply);
    $('#name-detail-one-get-one-campaign').text(res.data.data.name);
    $('#branch-detail-one-get-one-campaign').text(res.data.data.branches_text);
    $('#detail-info-detail-one-get-one-campaign').html(res.data.data.information);

}
function closeDetailOneGetOneMarketing(){
    $('#modal-detail-one-get-one-campaign').modal('hide');
}
