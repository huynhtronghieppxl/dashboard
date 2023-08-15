$.fn.isOnScreen = function() {
    let win = $(window);
    let viewport = {
        top: win.scrollTop(),
        left: win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
    let bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
};
// $(window).scroll(function() {
//     if ($('.tour-card1').isOnScreen()) {
//         chart_card2();
//     }
//     if($('.tour-card2').isOnScreen()) {
//         dataCard3();
//     }
//     if($('.tour-card3').isOnScreen()) {
//         data_card4();
//     }
// });