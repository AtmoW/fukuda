<?php

session_start();
include '../function.php';
include '../db.php';
$cart_count = 0;
if(isset($_POST['laser_id'])){
    
    $current_added_laser = get_laser_by_id($_POST['laser_id']);
    $price = $current_added_laser['price'];
    if($_POST['color'] == 'green'){
        $l_color = 'Зелёный луч';
        $price+=1500;
    } 
    if($_POST['color'] == 'red'){
        $l_color = 'Красный луч';
    }
    if($_POST['case'] == 'soft'){
        $l_case = 'Мягкий кес';
    }
    if($_POST['case'] == 'solid'){
        $l_case = 'Жёсткий кейс';
        $price+=500;
    }
    if(!isset($_SESSION['cart-list'])){
        
        $quantity = 1;
        $_SESSION['cart-list'][] = array(
            "id" => $_POST['laser_id'],
            "name" => $current_added_laser['name'],
            "color" => $l_color,
            "laser-case" => $l_case,
            "price" => $price ,
            "quantity" => 1
             );
    }
    
    $laser_check = false;
    
    if ( isset($_SESSION['cart-list']) ) {
        foreach ($_SESSION['cart-list'] as $value) {
            if ( $value["id"] == $current_added_laser["id"] ) {
                $laser_check = true;
            }
        }
        if ( !$laser_check ) {
                 $_SESSION['cart-list'][] = array(
                "id" => $_POST['laser_id'],
                "name" => $current_added_laser['name'],
                "l_color" => $l_color,
                "l_case" => $l_case,
                "price" => $price, 
                "quantity" => 1
                );
            }
            $cart_count = count('cart-list');
    }
    echo json_encode($_SESSION['cart-list']);
}