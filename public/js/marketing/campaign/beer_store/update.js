let checkSaveUpdateBeerStorage = 0, checkMinBill = 0;
async function SaveConfigBeerStore(){
    if (checkSaveUpdateBeerStorage === 1) return false;
    console.log({idFoodBeerStore})
    if(!idFoodBeerStore) {
        WarningNotify('Vui lòng thiết lập chính sách cho chương trình trớc khi cập nhập !');
        return false;
    }
    checkMinBill = 0;
    $('#min-bill-value input').each((i, v) => {
        if(i === $('#min-bill-value input').length - 1) return false;
        if(removeformatNumber($('#min-bill-value input').eq(i).val()) >= removeformatNumber($('#min-bill-value input').eq(i + 1).val())) {
            WarningNotify('Giá trị bill tối thiểu không hợp lệ !');
            checkMinBill = 1;
            return false;
        }
    });
    if (checkMinBill === 1) return false;
    let rowMonday = $('#table-beer-store-campaign tbody tr:eq(0)');
    let listConfigMonday = {
        'is_apply' : Number(rowMonday.find('td:eq(8) input').is(':checked')),
        "day_of_week": 0,
        'config' : [
            {
                'total_order_amount': removeformatNumber($('#first-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowMonday.find('td:eq(1) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#second-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowMonday.find('td:eq(2) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#third-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowMonday.find('td:eq(3) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fourth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowMonday.find('td:eq(4) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fifth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowMonday.find('td:eq(5) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#six-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowMonday.find('td:eq(6) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#seven-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowMonday.find('td:eq(7) input').val())
            }
        ]
    };

    let rowTuesday = $('#table-beer-store-campaign tbody tr:eq(1)');
    let listConfigTuesday = {
        'is_apply' : Number(Number(rowTuesday.find('td:eq(8) input').is(':checked'))),
        "day_of_week": 1,
        'config' : [
            {
                'total_order_amount': removeformatNumber($('#first-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowTuesday.find('td:eq(1) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#second-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowTuesday.find('td:eq(2) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#third-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowTuesday.find('td:eq(3) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fourth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowTuesday.find('td:eq(4) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fifth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowTuesday.find('td:eq(5) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#six-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowTuesday.find('td:eq(6) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#seven-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowTuesday.find('td:eq(7) input').val())
            }
        ]
    };

    let rowWednesday = $('#table-beer-store-campaign tbody tr:eq(2)');
    let listConfigWednesday = {
        'is_apply' : Number(Number(rowWednesday.find('td:eq(8) input').is(':checked'))),
        "day_of_week": 2,
        'config' : [
            {
                'total_order_amount': removeformatNumber($('#first-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowWednesday.find('td:eq(1) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#second-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowWednesday.find('td:eq(2) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#third-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowWednesday.find('td:eq(3) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fourth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowWednesday.find('td:eq(4) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fifth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowWednesday.find('td:eq(5) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#six-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowWednesday.find('td:eq(6) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#seven-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowWednesday.find('td:eq(7) input').val())
            }
        ]
    };

    let rowThursday = $('#table-beer-store-campaign tbody tr:eq(3)');
    let listConfigThursday = {
        'is_apply' : Number(Number(rowThursday.find('td:eq(8) input').is(':checked'))),
        "day_of_week": 3,
        'config' : [
            {
                'total_order_amount': removeformatNumber($('#first-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowThursday.find('td:eq(1) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#second-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowThursday.find('td:eq(2) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#third-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowThursday.find('td:eq(3) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fourth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowThursday.find('td:eq(4) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fifth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowThursday.find('td:eq(5) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#six-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowThursday.find('td:eq(6) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#seven-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowThursday.find('td:eq(7) input').val())
            }
        ]
    };

    let rowFriday = $('#table-beer-store-campaign tbody tr:eq(4)');
    let listConfigFriday = {
        'is_apply' : Number(Number(rowFriday.find('td:eq(8) input').is(':checked'))),
        "day_of_week": 4,
        'config' : [
            {
                'total_order_amount': removeformatNumber($('#first-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowFriday.find('td:eq(1) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#second-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowFriday.find('td:eq(2) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#third-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowFriday.find('td:eq(3) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fourth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowFriday.find('td:eq(4) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fifth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowFriday.find('td:eq(5) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#six-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowFriday.find('td:eq(6) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#seven-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowFriday.find('td:eq(7) input').val())
            }
        ]
    };

    let rowSaturday = $('#table-beer-store-campaign tbody tr:eq(5)');
    let listConfigSaturday = {
        'is_apply' : Number(Number(rowSaturday.find('td:eq(8) input').is(':checked'))),
        "day_of_week": 5,
        'config' : [
            {
                'total_order_amount': removeformatNumber($('#first-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSaturday.find('td:eq(1) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#second-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSaturday.find('td:eq(2) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#third-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSaturday.find('td:eq(3) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fourth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSaturday.find('td:eq(4) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fifth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSaturday.find('td:eq(5) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#six-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSaturday.find('td:eq(6) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#seven-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSaturday.find('td:eq(7) input').val())
            }
        ]
    };

    let rowSunday = $('#table-beer-store-campaign tbody tr:eq(6)');
    let listConfigSunday = {
        'is_apply' : Number(Number(rowSunday.find('td:eq(8) input').is(':checked'))),
        "day_of_week": 6,
        'config' : [
            {
                'total_order_amount': removeformatNumber($('#first-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSunday.find('td:eq(1) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#second-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSunday.find('td:eq(2) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#third-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSunday.find('td:eq(3) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fourth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSunday.find('td:eq(4) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#fifth-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSunday.find('td:eq(5) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#six-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSunday.find('td:eq(6) input').val())
            },
            {
                'total_order_amount': removeformatNumber($('#seven-amount-beer-store').val()),
                'maximum_use_quantity': removeformatNumber(rowSunday.find('td:eq(7) input').val())
            }
        ]
    };

    let method = 'post',
        url = 'beer-store.update-config',
        params = {},
        data = {
            'monday': listConfigMonday,
            'tuesday': listConfigTuesday,
            'wednesday': listConfigWednesday,
            'thursday': listConfigThursday ,
            'friday': listConfigFriday,
            'saturday': listConfigSaturday,
            'sunday': listConfigSunday ,
            'food_id': idFoodBeerStore,
            'brand_id': $('.select-brand').val(),
            'information': information,
            'notify_content_daily': notifyContentDaily,
            'notify_content_reset': notifyContentReset,
            'hour_send_notify': hourSendNotify,
            'banner_image_url': bannerUrl,
            'use_guide': useGuide,
            'term': termCampaign,
        };
    checkSaveUpdateBeerStorage = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#div-layout-store-campaign-campaign")]);
    checkSaveUpdateBeerStorage = 0;
    let text = 'Cập nhật thành công';
    switch (res.data[0].status){
        case 200:
            SuccessNotify(text);
            await loadBeerStoreCampaign();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data[0].message !== null) {
                text = res.data[0].message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data[0].message !== null)
                text = res.data[0].message;
            WarningNotify(text);
    }
}
