$(document).ready(function () {
    const links_with_id=$('.product_button');
    const cart = $('.cart');
    const minus_id = $('.quantity_minus');
    const plus_id = $('.quantity_plus');
    let prices = [];
    let total_price = 0;
    if($('.header__basket__text').text() != 'пусто'){
        cart_count = parseInt($('.header__basket__text span').text());
        total_price = parseInt($('.cart_total-price span').text());
        for(var i = 1; i<=parseInt(cart_count); i++){
            prices[i] =parseInt($('.cart_product[data-id="'+i+'"] .cart_product-price span').text());
        }
    }

    
    $.each(links_with_id, function(){
        $(this).bind('click', function(){
           let current_id = $(this).attr('data-id');
            if($('.form__case_soft[data-id = "'+current_id+'"]').is(':checked')){
                var laser_case = 'soft';
                
            }    
            if($('.form__case_solid[data-id = "'+current_id+'"]').is(':checked')){
                var laser_case = 'solid';
            }    
            if($('.form__color_g[data-id = "'+current_id+'"]').is(':checked')){
                var laser_color = 'green';
            }    
            if($('.form__color_r[data-id = "'+current_id+'"]').is(':checked')){
                var laser_color = 'red';
            }

            $.post("../control/api/cart-add.php", {"laser_id":current_id,"color":laser_color,"case":laser_case},
            function(data){
                cart.html('<div class="cart_products"></div>')
                data.forEach(function(item){
                    $('.cart_products').append('<div class="cart_product " data-id = "'+ item.id +'">'+
                       ' <div class="cart_delete">'+
                            '<div class="cart_delete-1"></div>'+
                            '<div class="cart_delete-2"></div>'+
                       '</div>'+
                       '<div class="cart_product-name">'+item.name+'</div>'+
                       '<div class="cart_product-color">'+
                       item.l_color+
                       '</div>'+
                       '<div class="cart_product-case">'+
                       item.l_case+
                       '</div>'+
                       ' <div data-id = "'+item.id+'" class = "cart_product-quantity quantity">'+
                           '<div class="quantity_plus" > + </div>'+
                           '<div class="quantity_number">'+
                               item.quantity+
                               
                           '</div>'+
                           '<div class="quantity_minus">'+
                               '<img src="img/cart/minus.png" alt="">'+
                           '</div>'+
                        '</div>'+
                       '<div class="cart_product-price"><span>'+
                        item.price + '</span> руб.'+
                       '</div>'+
                       '</div>');
                       prices[item.id] = parseInt(item.price);
                });
                console.log(prices);
                let cart_count = 0;
                total_price=0;
                prices.forEach(element => {
                    if(element>0){
                        total_price+=element;
                        cart_count++;
                    }
                });
                if(cart_count == 1){
                    $('.header__basket  .header__basket__text').html('<span>'+cart_count+'</span> товар');
                }
                if(cart_count > 1 && cart_count<5){
                    $('.header__basket  .header__basket__text').html('<span>'+cart_count+'</span> товара');
                }
                cart.append('<div class="cart_total-price">Итого: <span>руб.</span></div>'+
                            '<a data-fancybox data-src="#modal" href="javascript:;" href="#" class="cart_button"> Оформить заказ</a>');
                            $('.cart_total-price').html('Итого: <span>'+total_price+'</span> руб.');            
    

            },'json');
        });
    });


    $('.cart').on('click','.cart_products, .cart_product, .cart_delete',function(){
        let current_id = $(this).parent().attr('data-id');
        $.post("../control/api/cart-delete.php", {"delete_id":current_id},
        function(data){
            if(!isNaN(data) || parseInt(data,10)==0){
                total_price = 0;
                prices = [];
                $('.cart').html('<div class="cart__null"> Корзина пуста </div>');
                $('.header__basket  .header__basket__text').html('пусто');
            }
            else{
                $('.cart .cart_products .cart_product[data-id = "'+current_id+'"]').remove();
                prices[parseInt(current_id)] = 0;
                total_price = 0;
                cart_count = 0
                prices.forEach(element => {
                    if(element>0){
                        total_price+=element;
                        cart_count++;
                    }
                });
                $('.cart .cart_total-price span').html(total_price); 
                
                if(cart_count == 1){
                    $('.header__basket  .header__basket__text').html('<span>'+cart_count+'</span> товар');
                }
                if(cart_count > 1 && cart_count<5){
                    $('.header__basket  .header__basket__text').html('<span>'+cart_count+'</span> товара');
                }
            }
        }, 'json');
    });  


    $('.cart').on('click','.cart_products .cart_product .quantity_plus',function(){
        let current_id = $(this).parent().attr('data-id');
        $.post("../control/api/cart-quant.php", {"quant-id":current_id,"oper":'plus'},
        function(data){
            prices[current_id] = parseInt(data["price"]);
            total_price = 0;
            prices.forEach(element => {
                if(element>0){
                    total_price+=element;
                }
            });
            console.log(prices);
            
            $('.cart .cart_total-price span').html(total_price); 
            $('.cart .cart_products .cart_product[data-id="'+ current_id +'"] .quantity_number').text(data["quantity"]);
            $('.cart .cart_products .cart_product[data-id="'+ current_id +'"] .cart_product-price span').text(data["price"]);
        }, 'json');
        
    });  


    $('.cart').on('click','.cart_products, .cart_product,  .quantity_minus',function(){
        let current_id = $(this).parent().attr('data-id');
        $.post("../control/api/cart-quant.php", {"quant-id":current_id,"oper":'minus'},
        function(data){
            prices[current_id] = parseInt(data["price"]);
            total_price = 0;
            prices.forEach(element => {
                if(element>0){
                    total_price+=element;
                }
            });
            $('.cart .cart_total-price span').html(total_price); 
            $('.cart .cart_products .cart_product[data-id="'+ current_id +'"] .quantity_number').text(data["quantity"]);
            $('.cart .cart_products .cart_product[data-id="'+ current_id +'"] .cart_product-price span').text(data["price"]);
        }, 'json');
    });



});


