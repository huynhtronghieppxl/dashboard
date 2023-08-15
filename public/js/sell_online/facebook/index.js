$(function(){
    if (window.location.pathname === '/facebook-auth.login.index') {
        if($('.header-right-container .main-menu-1').find('em').hasClass('menu-active')){
            $('#box-view-content-auth-facebook .social-login').css({'height':'calc(100vh - 92px)', 'transition':'all 0.3s'});
        } else {
            $('#box-view-content-auth-facebook .social-login').css({'height':'calc(100vh - 58px)', 'transition':'all 0.3s'});
        }
    }

    $(document).on('click','.main-menu-1', function(){
        if($('.header-right-container .main-menu-1').find('em').hasClass('menu-active')){
            $('#box-view-content-auth-facebook .social-login').css({'height':'calc(100vh - 92px)', 'transition':'all 0.3s'});
        } else {
            $('#box-view-content-auth-facebook .social-login').css({'height':'calc(100vh - 58px)', 'transition':'all 0.3s'});
        }
    });
});

