<?php
$dbUser = 'fukuda-laser';
$dbName = 'fukuda-laser';
$dbPass = 'XgaB9btFUrlXxZrE';
$connection = mysqli_connect('127.0.0.1', $dbUser,$dbPass,$dbName);

if(mysqli_connect_errno()){
    die("Data Base connection failed: " . mysqli_connect_error() . "(". mysqli_connect_errno() .")");
}

mysqli_query($connection, "SET NAMES utf8");