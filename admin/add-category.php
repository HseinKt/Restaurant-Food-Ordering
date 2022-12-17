<?php  include('partials/menu.php');?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>

    <br><br>
    <!-- Add Category starts here-->
    <?php

    if(isset($_SESSION['add'])){
      echo $_SESSION['add'];
      unset($_SESSION['add']);
      echo "<br><br>";
    }
    echo "<br><br>";
    if(isset($_SESSION['upload'])){
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
      echo "<br><br>";
    }
    ?>

    <br><br>
    <form class="" action="" method="post" enctype="multipart/form-data">

      <table class="tbl-30">
        <tr>
          <td>Title: </td>
          <td>
            <input type="text" name="title" placeholder="Category Title">
          </td>
        </tr>

        <tr>
          <td>Select Image: </td>
          <td>
            <input type="file" name="image" >
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
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
          </td>
        </tr>

      </table>

    </form>


    <!-- Add Category ends here-->
    <?php
    //check if the submit button is clicked or not
    if(isset($_POST['submit'])){
      //get value from category form
      $title=$_POST['title'];

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

       //print_r($_FILES['image']);

       //die();  //Break the code here 
      //check if image is selected or not and set the value for image name
      if(isset($_FILES['image']['name']))
      {
        //upload the image
        //to upload image we need image nae and source file and Destination


        $image_name = $_FILES['image']['name'];

        //Upload the image only if image is slected 
        if($image_name != "")
        {

          //auto rename our image
          //get the etenstion of our image

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
            //stop the process in case it failed we don t want the data to go to the database
            die();
          }
        }
      }
      else{
        //don't upload image and image name value as blank
        $image_name="";
      }



      //create sql query to insert category into database
      $sql="INSERT INTO tbl_category SET
      title='$title',
      image_name='$image_name',
      featured='$featured',
      active='$active'
      ";
      //execute the query and save in database

      $res=mysqli_query($conn,$sql);

      //check if the query is executed or not

      if($res==true){
        //query executed
        $_SESSION['add']="<div class='sucess'>Category Added successfully.</div>";
        header("location:".SITEURL.'admin/manage-category.php');
      }
      else{
        //failed
        $_SESSION['add']="<div class='error'>Failed to Add Category.</div>";
        header("location:".SITEURL.'admin/add-category.php');
      }

    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>
