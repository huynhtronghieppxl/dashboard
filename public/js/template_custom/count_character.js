$(function () {
        let allElements = $('textarea');
        allElements.each(function() {
            let charCount = $(this).val().length;
            let result_default= $(this).attr('data-note-max-length')
            let result = charCount === 0 ?   '<span>0/'+result_default+'</span>' : '<span>'+charCount+ '/'+result_default+'</span>'
            $(this).parents('.form-group').find('.textarea-character').html(result)
        });
        $(document).on('input paste', 'textarea', function () {
            let charCount = $(this).val().length;
            let result_default= $(this).attr('data-note-max-length')
            let result = charCount === 0 ? `<span>0/${result_default}</span>` : `<span>${charCount}/${result_default}</span>`;
            $(this).parents('.form-group:first').find('.textarea-character').html(`${result}`)
        });
        $(document).on('click ', '.btn-renew', function () {
           countCharacterTextarea()
        });
})

function countCharacterTextarea () {
    let allElements = $('textarea');
    allElements.each(function() {
        let charCount = $(this).val().length;
        let result_default = $(this).attr('data-note-max-length')
        let result = charCount === 0 ? '<span>0/' + result_default + '</span>' : '<span>' + charCount + '/' + result_default + '</span>'
        $(this).parents('.form-group').find('.textarea-character').html(result)
    })
}

