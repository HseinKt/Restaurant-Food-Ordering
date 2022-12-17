<?php include('partials/menu.php'); ?>

<?php

  //check if id is set or not
  if(isset($_GET['id'])){
      //Get the id and all other details
      $id = $_GET['id'];

      //query to get all admin
      $sql2 = "SELECT * FROM tbl_food WHERE id = $id";

      //execute the query
      $res2 = mysqli_query($conn,$sql2);

          $count = mysqli_num_rows($res2);


              //Get all the data
              $row2 = mysqli_fetch_assoc($res2);

              $title = $row2['title'];
              $description= $row2['description'];
              $price=$row2['price'];
              $current_image = $row2['image_name'];
              $current_category = $row2['category_id'];
              $featured = $row2['featured'];
              $active = $row2['active'];
      }
  else{
      header('location:'.SITEURL.'admin/manage-food.php');
  }

?>


<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>

    <br><br>

    <form action="" method="post" enctype="multipart/form-data">

          <table class="tbl-30">
              <tr>
                  <td>Title: </td>
                  <td>
                      <input type="text" name="title" value="<?php echo $title ?>">
                  </td>
              </tr>

              <tr>
                  <td>Description: </td>
                  <td>
                      <textarea name= "description" cols=22 rows=3 ><?php echo $description; ?></textarea>
                  </td>
              </tr>

              <tr>
                  <td>Price: </td>
                  <td>
                      <input type="number" name="price" value="<?php echo $price; ?>">
                  </td>
              </tr>

              <tr>
                  <td>Current Image: </td>
                  <td>
                      <!-- Image will be display here  -->
                      <?php
                          if($current_image != ""){
                              //Display the image
                              ?>
                              <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="50px">
                              <?php
                          }
                          else{
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
                                      $category_id = $row['id'];
                                      $category_title = $row['title'];

                                      ?>
                                      <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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

                      <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                  </td>
              </tr>

          </table>

    </form>

    <?php

      //check if button checked or not

      if(isset($_POST['submit'])){

        $id = $_POST['id'];
        $title = $_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $current_image = $_POST['current_image'];
        $category=$_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //Updating new image if selected
        if(isset($_FILES['image']['name'])){
          $image_name = $_FILES['image']['name'];

          if($image_name != ""){
              //Image Available
              //A. Upload the new image

              $ext=end(explode('.',$image_name));

              //rename the image
              $image_name="Food-Name".rand(000,999).'.'.$ext;


              $src_path = $_FILES['image']['tmp_name'];
              $dest_path="../images/food/".$image_name;

              //finally upload image
              $upload=move_uploaded_file($src_path,$dest_path);

              //check if image is uploaded or not
              //and if not uploaded then we will stop the process and redirect with error message
              if($upload==false){
                  $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                  header('location:'.SITEURL.'admin/manage-food.php');
                  //stop the process
                  die();
              }
              //B. Remove the current image if available
              if($current_image != ""){

                  $remove_path = "../images/food/".$current_image;

                  $remove = unlink($remove_path);

                  //Check whether the image is removed or not
                  //if failed to remove then display message and stop the process
                  if($remove == false){
                      $_SESSION['remove-failed'] = "<div class='error'> Failed to Remove Current Image. </div>";
                      header('location:' .SITEURL. 'admin/manage-food.php');
                      die(); //Stop the Process
                  }
              }
        }
        else{
          $image_name=$current_image;//default image when image is not selected
        }
      }
        else{
          $image_name=$current_image;//default image when button is not clicked
        }

        //Update the DatBase
        $sql3 = "UPDATE tbl_food SET
        title = '$title',
        description='$description',
        price=$price,
        image_name = '$image_name',
        category_id=$category,
        featured = '$featured',
        active = '$active'
        where id = '$id'
        ";
        $res3 = mysqli_query($conn,$sql3);

        if($res3 == true){

            $_SESSION['update'] = "<div class='success'> Food Update Successfully.</div>";
            header('location:' .SITEURL. 'admin/manage-food.php');
        }

          else{

              $_SESSION['update'] = "<div class='error'> Failed to update food.</div>";
              header('location:' .SITEURL. 'admin/manage-food.php');
          }
      }


    ?>

  </div>
</div>



<?php include('partials/footer.php'); ?>
