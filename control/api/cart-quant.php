<?php
    session_start();
    
    if(isset($_POST['quant-id'])){
        foreach($_SESSION['cart-list'] as $value){
            if((int)$value['id'] == (int)$_POST['quant-id']){
                if($_POST['oper']=='plus'){
                    (int)$value['quantity']++;
                    (int)$value['price'] =(int)$value['price']/((int)$value['quantity']-1) * (int)$value['quantity'];
                }
                if($_POST['oper']=='minus' && $value['quantity']>1){
                    (int)$value['quantity']--;
                    (int)$value['price'] =(int)$value['price']/((int)$value['quantity']+1) * (int)$value['quantity'];
                }
                foreach ($_SESSION['cart-list'] as $key => $v) {
                    if ( (int)$v['id'] == (int)$_POST['quant-id'] ) {
                        $_SESSION['cart-list'][$key]['quantity'] = $value['quantity'];
                        $_SESSION['cart-list'][$key]['price'] = $value['price'];
                        unset($_POST['quant-id']);
                        unset($_POST['oper']);
                        echo json_encode($_SESSION['cart-list'][$key]);
                    }		
                }
            }
        }
    }




?>