<?php
  session_start();
  include("database.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/MutasmProject/css/index.css">
  <title>Log in</title>



  



<?php
  include("header.php");
?>

<body>


<div class="head-vector">
    <img src="/MutasmProject/assets/Index/head.svg">
  </div>

  <main>



    <?php if(!isset($_SESSION['email'])): ?>
      <div class="form-wrapper">


        <span class="form-half">
          <img src="/MutasmProject/assets/logo.svg"/>
          <p>Glad to see you!</p>
        </span>
        
        <form class="form-style" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
        <div class="box">
        <span class="fake-box">
          <img src="/MutasmPROJECT/assets/email.svg"> 
          <input type="email" name="email" placeholder="email" >
        </span>

        
        <span class="fake-box">
          <img src="/MutasmPROJECT/assets/lock.svg"> 
          <input type="password" name="password" placeholder="password" >
        </span>

          <input type="submit" name="submit" value="LOG IN" class="submit-box">


        </div>
      

        
        </form>
      </div>

    <?php else: ?>
      <div class="box-logged">
        <span class="fake-box-logged">
          <h4>You are Already Logged in</h4>
        </span>

      </div>
      <?php endif; ?>

      
      </main>
      <div class="foot-vector">
        <img src="/MutasmProject/assets/Index/foot.svg">
      </div>
      <?php include("footer.html"); ?>

</body>
</html>


<?php
 
  if($_SERVER["REQUEST_METHOD"] =="POST"){

    $email= filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty(($email))){
        echo"Please enter a email <br>";
    }
    else if(empty($password)){
      echo"Pleaser enter a password<br>";
    }
    else{

      $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

      
      if(mysqli_num_rows($result)>0){
        
        $user=mysqli_fetch_assoc($result);
        //$passwordhashed = password_hash($password,PASSWORD_DEFAULT);
        
          if($password== $user["password"]){
            $_SESSION["email"]= $user['email'];
            $_SESSION["name"]= $user['name'];
            $_SESSION["id"] = $user['id'];
          
            echo"<script>window.location.href='home.php';</script>";
          }
          else{
            echo"Incorrect password";
          }
       

      }else{
        echo"YOu are not found in";
      }


    }
    

  }

  mysqli_close($conn);



?>