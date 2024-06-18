<?php

  $db_server= "localhost";
  $db_user="root";
  $db_pass="";
  $db_name="aaudatabase";
  $conn="";

  try{

    $conn= mysqli_connect($db_server,
                          $db_user,
                          $db_pass,
                          $db_name);
  }
  catch(mysqli_sql_exception){
    echo"Could not connect! <br>";
  }


  /*$passwordhashed = password_hash($password,PASSWORD_DEFAULT);
  $sqlnigga= "INSERT INTO users (email,password,name,Major) VALUES ('nigga@hotmail.com','$passwordhashed','big NIgga','sic')";

 mysqli_query($conn, $sqlnigga);
*/


?>