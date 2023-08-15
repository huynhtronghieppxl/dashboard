let dataCarousel, idBooking, idDetailCustomerBookingTableManage;
function openModalDetailBookingTableManage(r) {
    $('#modal-detail-booking-table-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailBookingTableManage();
    });
    idBooking = r.data('id')
    idDetailCustomerBookingTableManage = r.data('customer');
    $('#modal-detail-food-brand-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailBookingTableManage();
        });
    });
    $('#icon-gift-detail').unbind('click').on('click', function (){
        if($(this).parent().find('.group-gift-selected').hasClass('d-none')){
            $(this).parent().find('.group-gift-selected').removeClass('d-none');
        }else {

            $(this).parent().find('.group-gift-selected').addClass('d-none');
        }
    });
    $(document).mouseup(function (e) {
        if ($(e.target).closest(".group-gift-selected").length === 0) {
            $(".group-gift-selected").addClass('d-none');
        }
    });
    $(document).on('click','#booking-table-detail-gift li', function (e){
        if (e.target.nodeName != 'INPUT' && e.target.nodeName != 'I'){
            openModalDetailGiftMarketing($(this))
        }
    })
    dataDetailBookingTableManage();
}



async function dataDetailBookingTableManage() {
    let method = 'get',
        url = 'booking-table-manage.detail',
        params = {
            id: idBooking,
            customer_id: idDetailCustomerBookingTableManage,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-food-detail-booking-table-manage'),
        $('#boxlist-detail-booking-table-manage')
    ]);
    $('.list-gift-detail-booking-table-manage').html(res.data[3])
    $('#total-gift-detail').text(res.data[0]['customer_gifts'].length)
    dataGiftDetailBookingTable(res.data[0].customer_gifts)
    $('#total-gift-detail-booking-table').text(res.data[0].customer_gifts.length)

    $('#status-detail-booking-table-manage').html(res.data[0].status);
    $('#branch-detail-booking-table-manage').text(res.data[0].branch.name);
    $('#type-detail-booking-table-manage').text(res.data[0].booking_type_name);
    $('#employee-detail-booking-table-manage').text(res.data[0].employee.name);
    $('#create-detail-booking-table-manage').text(res.data[0].created_at);
    $('#booking-detail-booking-table-manage').text(res.data[0].booking_time);
    $('#area-detail-booking-table-manage').text(res.data[0].area);
    $('#table-detail-booking-table-manage').text(res.data[0].tables);
    $('#customer-name-detail-booking-table-manage').text(res.data[0].customer_name);
    $('#customer-phone-detail-booking-table-manage').text(res.data[0].customer_phone);
    $('#number-detail-booking-table-manage').text(res.data[0].number_slot);
    $('#deposit-amount-detail-booking-table-manage').text(res.data[0].deposit_amount);
    $('#receive-deposit-time-detail-booking-table-manage').text(res.data[0].receive_deposit_time);
    $('#return-deposit-amount-detail-booking-table-manage').text(res.data[0].return_deposit_amount);
    $('#return-deposit-time-detail-booking-table-manage').text(res.data[0].return_deposit_time);
    $('#total-final-detail-booking-table-manage').text(res.data[0].total_amount);
    $('#other-requirements-detail-booking-table-manage').text(res.data[0].orther_requirements);
    $('#order-detail-booking-table-manage').text(res.data[0].order_id);
    $('#note-detail-booking-table-manage').text(res.data[0].note);
    $('#cancel-reason-detail-booking-table-manage').text(res.data[0].cancel_reason);

    $('#tag-detail-booking-table-manage').html(res.data[4]);
    $('#tag-detail-booking-table-manage').text(res.data[5]).trigger('change.select2');

    if (parseInt(res.data[0].booking_status) === 5) {
        $('#div-cancel-reason-detail-booking-table-manage').removeClass('d-none');
    } else {
        $('#div-cancel-reason-detail-booking-table-manage').addClass('d-none');
    }
    if (parseInt(res.data[0].return_deposit_amount) > 0) {
        $('#return-deposit-amount-detail-booking-table-manage').addClass('text-danger font-weight-bold');
    }
    let id_table = $('#table-food-detail-booking-table-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],option = []
    DatatableTemplateNew(id_table, res.data[1].original.data, columns, scroll_Y, fixed_left, fixed_right,option);
}


function closeModalDetailBookingTableManage() {
    $('#modal-detail-booking-table-manage').modal('hide');
    reloadModalDetailBookingTableManage()
}

function reloadModalDetailBookingTableManage(){
    $('#status-detail-booking-table-manage').html('');
    $('#return-deposit-amount-detail-booking-table-manage').removeClass('text-danger font-weight-bold');
    $('#status-detail-booking-table-manage').html('');
    $('#branch-detail-booking-table-manage').text('---');
    $('#type-detail-booking-table-manage').text('---');
    $('#employee-detail-booking-table-manage').text('---');
    $('#create-detail-booking-table-manage').text('---');
    $('#booking-detail-booking-table-manage').text('---');
    $('#area-detail-booking-table-manage').text('---');
    $('#table-detail-booking-table-manage').text('---');
    $('#customer-name-detail-booking-table-manage').text('---');
    $('#customer-phone-detail-booking-table-manage').text('---');
    $('#number-detail-booking-table-manage').text('---');
    $('#deposit-amount-detail-booking-table-manage').text('---');
    $('#receive-deposit-time-detail-booking-table-manage').text('---');
    $('#return-deposit-amount-detail-booking-table-manage').text('---');
    $('#return-deposit-time-detail-booking-table-manage').text('---');
    $('#total-final-detail-booking-table-manage').text('---');
    $('#other-requirements-detail-booking-table-manage').val('---');
    $('#order-detail-booking-table-manage').text('---');
    $('#note-detail-booking-table-manage').val('---');
    $('#cancel-reason-detail-booking-table-manage').text('---');
}
