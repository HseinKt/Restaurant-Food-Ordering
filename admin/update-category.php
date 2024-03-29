<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>

    <br><br>
    <?php
        //Check whether the id is set or not 
        if(isset($_GET['id']))
        {
            //Get the id and all other details
            $id = $_GET['id'];

            //query to get all admin
            $sql = "SELECT * FROM tbl_category WHERE id = $id";

            //execute the query
            $res = mysqli_query($conn,$sql);

            if($res == true)
            {
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    
                }
                else
                {
                    $_SESSION['no-categoey-found'] = "<div class='error'>Category not found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    ?>


    <form class="" action="" method="post" enctype="multipart/form-data">

        <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </td>
        </tr>

        <tr>
            <td>Current Image: </td>
            <td>
                <!-- Image will be display here  -->
                <?php
                    if($current_image != "")
                    {
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="80px">
                        <?php
                    }
                    else
                    {
                        echo "<div class='error'> Image Not Added </div>";
                    }
                ?>
            </td>
        </tr>

        <tr>
            <td>New Image: </td>
            <td>
                <input type="file" name="image" >
            </td>
        </tr>

        <tr>
            <td>Featured: </td>
            <td>
                <input <?php if($featured == "Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                
                <input <?php if($featured == "No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active: </td>
            <td>
                <input <?php if($active == "Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                
                <input <?php if($active == "No"){ echo "checked";} ?> type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
            </td>
        </tr>

        </table>

    </form>
  </div>
</div>

<?php 
     
    if(isset($_POST['submit']))
    {
        //echo"update successfully";
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //Updating new image if selected
        if(isset($_FILES['image']['name']))
        {
            //Get The Image Details
            $image_name = $_FILES['image']['name'];

            //Check whether the image is available or not 
            if($image_name != "")
            {
                //Image Available   
                //A. Upload the new image
                
                $ext=end(explode('.',$image_name));

                //rename the image
                $image_name="Food_Category_".rand(000,999).'.'.$ext;//e.g. Food_Category_875.jpg


                $source_path = $_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;

                //finally upload image
                $upload=move_uploaded_file($source_path,$destination_path);

                //check if image is uploaded or not
                //and if not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                    $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process 
                    die();
                }

                //B. Remove the current image if available
                if($current_image != "")
                {
                    $remove_path = "../images/category/".$current_image;

                    $remove = unlink($remove_path);
    
                    //Check whether the image is removed or not 
                    //if failed to remove then display message and stop the process
                    if($remove == false)
                    {
                        $_SESSION['failed-remove'] = "<div class='error'> Failed to Remove Current Image. </div>";
                        header('location:' .SITEURL. 'admin/manage-category.php');
                        die(); //Stop the Process
                    }
                }
            }
            else
            {
                $image_name = $current_image;
            }
        }
        else
        {
            $image_name = $current_image;
        }

        //Update the DatBase
        $sql = "UPDATE tbl_category SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        where id = '$id'
        ";

        $res = mysqli_query($conn,$sql);

        if($res == true){

            $_SESSION['update'] = "<div class='success'> Category Update Successfully.</div>";
            header('location:' .SITEURL. 'admin/manage-category.php');
        }
        else{

            $_SESSION['update'] = "<div class='error'> Failed to update category.</div>";
            header('location:' .SITEURL. 'admin/manage-category.php');
        }

    }
?>

<?php include('partials/footer.php'); ?>