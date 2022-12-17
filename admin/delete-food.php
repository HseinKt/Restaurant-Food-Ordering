<?php

    include('../config/constants.php');

    //Check whether the id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //1. get the ID 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            //image is available. so remove it
            $path = "../images/food/".$image_name;

            //Remove the image
            $remove = unlink($path);

            //check if image is removed
            if($remove==false){
                //session message
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Food Image</div>";
                //Redirect
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process
                die();
            }
        }

        //Delete data from database
        $sql = "DELETE  FROM  tbl_food where id = $id ";
        //execute the query
        $res = mysqli_query($conn,$sql);

        if($res==true){

            $_SESSION['delete'] = "<div class = 'success'>Food Deleted Successfully.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else {
            //Failed to delete food  "
            $_SESSION['unauthorized'] = "<div class = 'error'>Failed to delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
