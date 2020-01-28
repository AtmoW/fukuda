<?php
session_start();
include '../db.php';
if(isset($_POST['delete_id'])){
    foreach ($_SESSION['cart-list'] as $key => $value) {
        if ( (int)$value['id'] == (int)$_POST['delete_id'] ) {
            unset($_SESSION['cart-list'][$key]);
        }	
    }
    if(count($_SESSION['cart-list'])==0 || !isset($_SESSION['cart-list'])){
        echo 0;
    }
    else{
        echo json_encode($_SESSION['cart-list']);
    }
}