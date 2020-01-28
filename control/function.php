<?php
    session_start();
    require_once 'db.php';

    function get_laser_by_id( $id ){
        global $connection;
        
        $query = "SELECT * FROM `products` WHERE id='$id'";
        $req = mysqli_query($connection, $query);
        $resp = mysqli_fetch_assoc($req);
        

        return $resp;
    }

    function create_cart(){
        if(!isset($_SESSION['cart-list']) || count($_SESSION['cart-list']) < 1){
            echo '<div class="cart__null"> Корзина пуста </div>';
        }else{
            echo' <div class="cart_products">';
            foreach($_SESSION['cart-list'] as $value){
                $total_price += $value['price'];
            echo '<div class="cart_product" data-id="'.$value['id'].'">
                                <div  class="cart_delete">
                                    <div class="cart_delete-1"></div>
                                    <div class="cart_delete-2"></div>
                                </div>
                                <div class="cart_product-name">
                                    '.$value['name'].'
                                </div>
                                <div class="cart_product-color">
                                '.$value['l_color'].'
                                </div>
                                <div class="cart_product-case">
                                '.$value['l_case'].'
                                </div>
                                <div data-id="'.$value['id'].'" class = "cart_product-quantity quantity">
                                    <div class="quantity_plus">
                                        +
                                    </div>
                                    <div class="quantity_number">
                                        '.$value['quantity'].'
                                    </div>
                                    <div class="quantity_minus">
                                        <img src="img/cart/minus.png" alt="">
                                    </div>
                                </div>    
                                <div class="cart_product-price">
                                <span>'.$value['price'].'</span> руб.
                                </div>
                            </div>';
        }
        echo '</div>
           <div class="cart_total-price">
           Итого: <span>'.$total_price.'</span> руб.
       </div>
       <a data-fancybox data-src="#modal" href="javascript:;" href="#" class="cart_button">
           Оформить заказ
       </a>';
    }
}

    