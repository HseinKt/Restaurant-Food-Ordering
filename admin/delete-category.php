<?php

    include('../config/constants.php');

    //Check whether the id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //1. get the ID of Admin to be deleted
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            //image is available. so remove it  
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);
            if($remove==false)
            {
                //session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                //Redirect
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }

        //Delete data from database
        $sql = "DELETE  FROM  tbl_category where id = $id ";
        //execute the query
        $res = mysqli_query($conn,$sql);

        if($res==true){

            $_SESSION['delete'] = "<div class = 'success'>Category Deleted Successfully.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else {
            //Failed to delete admin  "
            $_SESSION['delete'] = "<div class = 'error'>Failed to Delete Category. try Again Later.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>