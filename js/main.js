$(document).ready(function () {
    $(".slider").slick({
        autoplay: false,
        dots: true,
        arrows:false,
        vertical: true,
        customPaging: function (slider, i) {
            var thumb = $(slider.$slides[i]).data('thumb');
            return '<a><img src="' + thumb + '"></a>';
        },
    });

    $('.burger').click(function(event){
        $('.burger, .menu').toggleClass('active');
        $('body').toggleClass('lock')
    });

    $('.header__basket').click(function(){
        $('.header__basket, .cart').toggleClass('active');
    });
    
    $('.form__color input[type=radio]').change(function(){
        let f_id = $(this).attr('data-id');
        let default_prc = $('.form__price[data-id = "'+f_id+'"] span').text();
        let prc = parseInt(default_prc)  + parseInt($(this).data('price'));
        console.log($(this).attr('data-price'));
        
            $('.form__price[data-id = "'+f_id+'"] span').text(prc);
            $('.form__price[data-id = "'+f_id+'"] span').text(prc); 
    });
    $('.form__case input[type=radio]').change(function(){
        let f_id = $(this).attr('data-id');
        let default_prc = $('.form__price[data-id = "'+f_id+'"] span').text();
        let prc = parseInt(default_prc)  + parseInt($(this).data('price'));
        console.log($(this).attr('data-price'));
        
            $('.form__price[data-id = "'+f_id+'"] span').text(prc);
            $('.form__price[data-id = "'+f_id+'"] span').text(prc); 
    });
    
});