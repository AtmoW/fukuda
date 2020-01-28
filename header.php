<?php
    session_start();
    if(! isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    if(! isset($_SESSION['cart-list'])){
        $_SESSION['cart-list'] = array();
    }
 include 'control/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <meta http-equiv="Cache-Control" content="no-cache">
    <title>FUKUDA</title>
    <link rel="shortcut icon" href="/img/icon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lora|Roboto:400,500,700&display=swap&subset=cyrillic"
        rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
    include 'modal.php';
?>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__burger burger">
                    <span></span>
                </div>
                <nav class="header__menu menu">
                    <ul class="menu__list">
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Клиентам</a></li>
                        <li><a href="#">О нас</a></li>
                        <li><div class="header__phone"><a href="tel:+79382314234">+7(938)-231-42-34</a></div></li>
                    </ul>
                </nav>
                
                <div class="header__basket">
                        <div class="header__basket__img"><img src="img/top-basket.png" alt=""></div>
                        <div class="header__basket__text" id = "cartCntItems">
                        <?php if (isset($_SESSION['cart-list'])){
                            if(count($_SESSION['cart-list']) == 0 ){
                                echo 'пусто';
                            }

                            if (count($_SESSION['cart-list']) == 1){
                                echo '<span>'.count($_SESSION['cart-list']).'</span>' . ' товар';
                            }

                            if(count($_SESSION['cart-list']) > 1 && count($_SESSION['cart']) < 5){
                                echo '<span>'.count($_SESSION['cart-list']).'</span>' . ' товара';
                            }
                            
                        }
                        else{
                            echo 'пусто';
                        }
                        ?>
                        </div>
                </div>
                <div class="cart">
                
                        <?php 
                            create_cart();
                        ?>
                </div>
            </div>
        </div>
    </header>