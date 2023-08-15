$(function (){
    /**
     * Kiểm tra hiển thị active messenger
     */
    $('.dashboard-facebook-conversation-filter-list .dashboard-facebook-conversation-filter-item :eq(0)').addClass('active');
    $(document).on('click','.dashboard-facebook-conversation-filter-item', function(){
        $('.dashboard-facebook-conversation-filter-list .dashboard-facebook-conversation-filter-item').removeClass('active');
        $(this).addClass('active');
    });
    /**
     * Ràng buộc độ dài khi ẩn hiện tin nhắn ghim
     */
    if($('.dashboard-facebook-body-pin').hasClass('d-none')){
        $(this).parent().find('.dashboard-facebook-body-chat').css('margin-top','0px');
        $(this).parent().find('.dashboard-facebook-body-chat').css('height','calc(100vh - 290px)');
    }
    else {
        $(this).parent().find('.dashboard-facebook-body-chat').css('margin-top','60px');
        $(this).parent().find('.dashboard-facebook-body-chat').css('height','calc(100vh - 230px)');
    }
    /**
     * Search messenger in list user
     */
    $(document).on('input','#dashboard-facebook-filter-search-input',function (){
        let valueSearch = removeVietnameseStringLowerCase($(this).val()) ;
        $('.dashboard-facebook-conversation-filter-list.active .dashboard-facebook-conversation-filter-item').each(function (i,e){
            let listNameMessenger = removeVietnameseStringLowerCase($(this).find('.dashboard-facebook-conversation-filter-name-text').text());
            $(this).closest('.dashboard-facebook-conversation-filter-list.active .dashboard-facebook-conversation-filter-item')[listNameMessenger.indexOf(valueSearch) !== -1 ? 'show' : 'hide']();
        })
    });
})
