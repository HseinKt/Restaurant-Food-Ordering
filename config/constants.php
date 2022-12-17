<?php
    //start Session
    session_start();

    define('SITEURL','http://localhost/foodorder/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','foodorder');

    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die(mysqli_error());//connection to database
    $db_select =mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database
?>
