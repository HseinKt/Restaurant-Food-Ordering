<?php

    include('../config/constants.php');
    //1. get the ID of Admin to be deleted
    $id = $_GET['id'];
    //2. Created SQLQuery to delete Admin
    $sql = "DELETE  FROM  tbl_admin where id = $id ";
    //execute the query
    $res = mysqli_query($conn,$sql);

    if($res==true){
        //Query executed succesfully and admin deleted
        //Create session variable to display message
        $_SESSION['delete'] = "Admin Delete Successfully";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else {
        //Failed to delete admin
        $_SESSION['delete'] = "Failed to Delete Admin . try Again Later";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3. Redirect to manage admin page with message (sussec / error)

?>
