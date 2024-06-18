<?php
  session_start();

  include("database.php");
 

?>

<!DOCTYPE html>
<html lang="en">
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/MutasmProject/css/profile.css">
    <title>Home</title>



<?php
  include("header.php");
?>

<body>




<div class="form-wrapper">
 
  
  <form class="form-style" enctype="multipart/form-data" method="POST" >

  <div class="box">
  <span class="fake-box">
    
    <input type="file" name="image">
  </span>



    <input type="submit" name="submit" value="SUBMIT" class="submit-box">


  </div>
   
  </form>
</div>
</body>

</html>

<?php

  if(isset($_POST['submit'])&& isset($_SESSION['id'])){
    $file_name= $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = "Images/Profiles/".$file_name;

    $query = mysqli_query($conn, "UPDATE users SET file_name='$file_name' WHERE id=$id");
    if(move_uploaded_file($tempname, $folder)){
      echo "<h2>File uploaded Sucessfully</h2>";

    }else{
      echo"file didn't upload";
    }
  }

?>