<?php  include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <!-- Add Food starts here-->
        <?php
          if(isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }

            if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
            echo "<br><br>";
            }
        ?>
        <form  action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name= "description" cols=22 rows=3 placeholder= "Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name ="category">
                            <?php
                                //Create php Code to display category from DB
                                //1. Create sql to get all active categories from DB
                                $sql = "SELECT * FROM tbl_category WHERE  active='Yes'";

                                $res = mysqli_query($conn,$sql);

                                $count = mysqli_num_rows($res);

                                if($count > 0){
                                    //We have category
                                    while($row=mysqli_fetch_assoc($res)){
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else{
                                    //we don't have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

          if(isset($_POST['submit'])){

            //1. Get the Data from form
            $title=$_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if(isset($_POST['featured'])){
                //get the value
                $featured=$_POST['featured'];
            }
            else{
                //set default value
                $featured="No";
            }

            if(isset($_POST['active'])){
                $active=$_POST['active'];
            }
            else{
                $active="No";
            }

            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                //Upload the image only if image is slected
                if($image_name != ""){
                    //Image is selected
                    //auto rename our image
                    //get the etenstion of selected image (jpg, png, gif, etc..)

                    $ext = end(explode('.',$image_name));

                    //rename the image
                    $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;//e.g. Food_Name_875.jpg

                    $src = $_FILES['image']['tmp_name'];
                    $dst="../images/food/".$image_name;

                    //finally upload image
                    $upload=move_uploaded_file($src,$dst);

                    //check if image is uploaded or not
                    //and if not uploaded then we will stop the process and redirect with error message
                    if($upload==false){
                        $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop the process in case it failed we don t want the data to go to the database
                        die();
                    }
                }
              }
              else{
                //don't upload image and image name value as blank
                $image_name="";
              }
              $sql2="INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
              ";


              $res2=mysqli_query($conn,$sql2);


              if($res2 == true){
                //data inserted successfully
                $_SESSION['add'] = "<div class='sucess'>Food Added successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
              }
              else{
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:'.SITEURL.'admin/add-food.php');
              }
          }


        ?>
    </div>
</div>
<?php  include('partials/footer.php');?>
