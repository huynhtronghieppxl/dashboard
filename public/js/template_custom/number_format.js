function formatNumber(num) {
    // return num.toLocaleString(undefined);
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formatNumberLimit(num) {
    // return num.toLocaleString(undefined, { maximumFractionDigits: 0 });
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function removeformatNumber(num) {
    num = String(num);
    return Number(num.replace(/[^0-9.-]+/g, ""));
}

$(document).on("input", "input[data-type='currency-edit']", function () {
    formatCurrency($(this));
});

function formatNumberCurrency(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


$(document).on("input", "input[data-type='currency-edit-number']", function () {
    formatCurrencyNumber($(this));
});


function formatCurrency(input, blur) {
    let input_val = input.val();
    if (input_val === "") {
        return;
    }
    let original_len = input_val.length;
    let caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        let decimal_pos = input_val.indexOf(".");
        let left_side = input_val.substring(0, decimal_pos);
        let right_side = input_val.substring(decimal_pos);
        left_side = formatNumberCurrency(left_side);
        right_side = formatNumberCurrency(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side;
    } else {
        input_val = formatNumberCurrency(input_val);
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    input.val(input_val);
    let updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function formatCurrencyNumber(input, blur) {
    let input_val = input.val();
    let number = (input.data('number-currency') == undefined) ? 2 : input.data('number-currency') ;
    if (input_val === "") {
        return;
    }
    let original_len = input_val.length;
    let caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        let decimal_pos = input_val.indexOf(".");
        let left_side = input_val.substring(0, decimal_pos);
        let right_side = input_val.substring(decimal_pos);
            left_side = formatNumberCurrency(left_side);
            right_side = formatNumberCurrency(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, number);
        right_side = right_side.replace(',', "");
        input_val = left_side + "." + right_side;
    } else {
        console.log(2);
        input_val = formatNumberCurrency(input_val);
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    input.val(input_val);
    let updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}


function formartFloat(input_val){
    input_val = String(input_val);
    if (input_val.indexOf(".") > 0) {
        let decimal_pos = input_val.indexOf(".");
        let left_side = input_val.substring(0, decimal_pos);
        let right_side = input_val.substring(decimal_pos);
        left_side = formatNumberCurrency(left_side);
        // right_side = formatNumberCurrency(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(1, 3);

        input_val = left_side + "." + right_side;
    } else {
        input_val = formatNumberCurrency(input_val);
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    return input_val;
}

function nFormatter(num) {
    let digits = 1;
    let si = [
        {value: 1, symbol: ""},
        {value: 1E3, symbol: " Nghìn"},
        {value: 1E6, symbol: " Triệu"},
        {value: 1E9, symbol: " Tỷ"},
    ];
    let rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    let i;
    if (num >= 0) {
        for (i = si.length - 1; i > 0; i--) {
            if (num >= si[i].value) {
                break;
            }
        }
    }
    if (num < 0) {
        for (i = si.length - 1; i > 0; i--) {
            if (num <= -(si[i].value)) {
                break;
            }
        }
    }
    return (num / si[i].value).toFixed(digits).replace(rx, "$1") + si[i].symbol;
}
