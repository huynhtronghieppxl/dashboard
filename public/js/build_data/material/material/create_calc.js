function openModalCalcCreateMaterialData() {
    $('#modal-calc-create-material-data').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCalcCreateMaterialData();
    });
    $(document).on('click', '#btn-add-input-calc-quantity-loss', function (){
        $('#modal-calc-create-material-data .btn-renew').removeClass('d-none');
    })
    $(document).on('input paste', '.quantity-buy-create-material-data', function (){
        totalAverage();
    })
    $(document).on('input paste', '.quantity-buy-create-material-data, .quantity-receive-create-material-data', function (){
        let buy = removeformatNumber($(this).parents('.calc-percent').find('.quantity-buy-create-material-data').val());
        let receive = removeformatNumber($(this).parents('.calc-percent').find('.quantity-receive-create-material-data').val());
        let loss = ((buy-receive) / buy) * 100;
        if(loss == '-Infinity'){
            $(this).parents('.calc-percent').find('.loss-average-create-material-data').text(0)
        }else{
            if(loss.toFixed(2) == 'NaN'){
                $(this).parents('.calc-percent').find('.loss-average-create-material-data').text(0);
            }else{
                $(this).parents('.calc-percent').find('.loss-average-create-material-data').text(loss.toFixed(2));
            }
        }
        totalAverage();
        $('#modal-calc-create-material-data .btn-renew').removeClass('d-none');
    });
    $(document).on('click','.remove-calc-percent', function () {
        $(this).parents('.calc-percent').remove();
        ($('.calc-percent').length < 3) ? $('#btn-add-input-calc-quantity-loss').removeClass('d-none')  : $('#btn-add-input-calc-quantity-loss').addClass('d-none');
        ($('.calc-percent').length < 1) ? $('#btn-confirm-create-calc-material').addClass('d-none') : $('#btn-confirm-create-calc-material').removeClass('d-none');
        ($('.calc-percent').length < 1) ? $('#title-calc-loss-material').addClass('d-none') : $('#title-calc-loss-material').removeClass('d-none');
        totalAverage();
    })
    $('#btn-add-input-calc-quantity-loss').unbind('click').on('click', function (){
        $('#add-input-calc-quantity-loss').append(`
            <div class="row calc-percent col-lg-12 pb-2">
                <div class="col-md-4">
                    <div class="input-group border-group validate-table-validate">
                         <input class="form-control rounded text-center border-0 w-100 quantity-buy-create-material-data" value="1" data-min="1" data-max="999999">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group border-group validate-table-validate">
                         <input class="form-control rounded text-center border-0 w-100 quantity-receive-create-material-data" value="1" data-max="999999" data-type="currency-edit">
                    </div>
                </div>
                <div class="col-md-2 text-center pt-2">
                    <label class="text loss-average-create-material-data" style="color: #fa6342">
                        0
                    </label>
                </div>
                 <div class="col-md-2 remove-calc-percent">
                        <i class="fa fa-trash-o btn-convert-left-to-right mr-0 mt-1 cursor-pointer" style="font-size: 23px;"></i>
                </div>
                </div>
        `);
        ($('.calc-percent').length === 3) ? $('#btn-add-input-calc-quantity-loss').addClass('d-none') : $('#btn-add-input-calc-quantity-loss').removeClass('d-none');
        ($('.calc-percent').length > 0) ? $('#title-calc-loss-material').removeClass('d-none') : $('#title-calc-loss-material').addClass('d-none');
        ($('.calc-percent').length > 0) ? $('#btn-confirm-create-calc-material').removeClass('d-none') : $('#btn-confirm-create-calc-material').addClass('d-none');
    });
}

function totalAverage(){
    let average = 0;
    $('.calc-percent').each(function (){
        average = average + parseFloat($(this).find('.loss-average-create-material-data').text());
    })
    if ($('.calc-percent').length === 0){
        $('#loss-average-all-create-material-data').text('0')
    }
    else{
        $('#loss-average-all-create-material-data').text(formatNumber((average / $('.calc-percent').length).toFixed(2)));
    }
}

function confirmModalCalcCreateMaterialData() {
    $('#loss-create-material-data').val($('#loss-average-all-create-material-data').text());
    $('#loss-update-material-data').val($('#loss-average-all-create-material-data').text());
    $('#modal-calc-create-material-data').modal('hide');
}

function closeModalCalcCreateMaterialData() {
    $('#modal-calc-create-material-data').modal('hide');
    shortcut.remove('ESC');
}

function resetModalCalcCreateMaterialData() {
    $('#modal-calc-create-material-data input').val(1);
    $('#loss-average-all-create-material-data').text(0);
    $('.loss-average-create-material-data').text(0);
    $('#modal-calc-create-material-data .btn-renew').addClass('d-none');
}
