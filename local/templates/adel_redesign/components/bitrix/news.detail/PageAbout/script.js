$(document).ready(function(){

    $('.PageAbout-btn-more').click(function () {
        var btn = $(this);
        $('.PageAbout-detail-text').slideToggle(function () {
            if (btn.text() === "Подробнее...") {
                btn.text('Свернуть');
            }else{
                btn.text('Подробнее...');
            }
        });
    });
});