<?php
    include('../config/constants.php');
    // distroy the session and redirect to login page
    session_destroy();//unset $_SESSION['user']

    header("location:".SITEURL.'admin/login.php');
 ?>
