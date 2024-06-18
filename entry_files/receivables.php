<?php
ob_start();

session_start();
include("database.php");
require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

function fines_confirm($book_fine, $book_id, $book_name, $today_date, $username, $id, $user_fines) {
    $options = new Options();
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);
    
    $dompdf = new Dompdf($options);

    $html = file_get_contents("template.html");

    $html = str_replace(
        ["{{name}}", "{{id}}", "{{book_id}}", "{{book_name}}", "{{book_fine}}", "{{user_fines}}", "{{today}}"], 
        [$username, $id, $book_id, $book_name, $book_fine, $user_fines, $today_date], 
        $html
    );

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->add_info("Title", "An Example PDF");

    ob_end_clean();

    $dompdf->stream("Payment Invoice.pdf", ["Attachment" => 0]);

    $output = $dompdf->output();

    $directory = __DIR__ . "/pdfFiles/User Fines/";
    $file_name = "Invoice_" . $id . "_".$book_id."_". $today_date . ".pdf"; 
    $file_path = $directory . $file_name;
    file_put_contents($file_path, $output);



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/MutasmProject/css/receive.css">
  <title>Receivables</title>
<?php include("header.php")?>
<body>

<main>
  
      <div class="head-vector">
          <img src="/MutasmProject/assets/Receive/head.svg">
        </div>

  <div class="wrapper-user">

    <div class="wrapper-basic">
      <span class="basic-picture">
          <?php if(isset($_SESSION['id'])){
              $result = mysqli_query($conn, "SELECT file_name FROM users WHERE id='$id'");
            
              while($row=mysqli_fetch_assoc($result)){ ?>
          <img src="Images/Profiles/<?php echo $row['file_name'] ?>" />
          <?php } }?>
          
          </span>
          <span class="basic-facts">
            <ul>
              <li><strong>ID: </strong><?php echo$id;?></li>
              <li><strong>Name: </strong><?php echo$userName;?></li>
              <li><strong>Major: </strong><?php echo implode("",$userMajor);?></li>
            </ul>
          </span>

    </div>

    
    <div class="slider">
      
      <div class="slides">
        
          <ul>
          <?php
              $result_library = mysqli_query($conn, "SELECT name,start_date,end_date,book_img from library WHERE owend_by='$id'");

                      if (mysqli_num_rows($result_library) > 0){
                        while ($row = mysqli_fetch_assoc($result_library)) {
                          //echo $today_date;
                          //echo $row['name']." ".$row['end_date'].'<br>';
                          
                          echo "<li class='slide'><img src='Images/Books/".$row['book_img']."'/>";
                          echo "<strong style='font-size: 20px'>". $row['name']."</strong>";
                          echo "Start Date:". $row['start_date']."<br>End Date:".$row['end_date']."</li>";
                          
                        }
                      }

        
        ?>
          </ul>
          
      </div>
      <button class="prev" onclick="prevSlide()">&#10094</button>
      <button class="next" onclick="nextSlide()">&#10095</button>

      
    </div>
    <div class="wrapper-financial">
      <div class="clearance-financial">
        <h5>Current State Of Fines</h5>
        <?php
        $outside_fines=0;


          $today_date = date("Y-m-d");

          $check_last_update = "SELECT last_update, fines FROM users WHERE id='$id'";
          $result_last_update = mysqli_query($conn, $check_last_update);

          
          if($result_last_update){

            $last_update_row = mysqli_fetch_assoc($result_last_update);

            
          if($last_update_row['last_update']!= $today_date){
            $user_fines = 0;


                $check_dates="SELECT name,end_date FROM library where owend_by='$id'";

                $result_dates = mysqli_query($conn, $check_dates);
                if (mysqli_num_rows($result_dates) > 0){

                  
                  while ($row = mysqli_fetch_assoc($result_dates)) {

                    $end_date = $row['end_date'];

                    if($row['end_date'] < $today_date){

  
                      $start = strtotime($today_date);
                      $end = strtotime($end_date);


                      $diff_seconds = $start - $end;

                      $days_difference = floor($diff_seconds / (60 * 60 * 24));

                      $user_fines += ($days_difference) * 5.00;
                      $outside_fines = $user_fines;
                    }
                  }
                  $new_total_fines = $last_update_row['fines'] + $user_fines;

                  $updateFines = "UPDATE users SET fines = '$new_total_fines', last_update = '$today_date' WHERE id='$id'";

                  $resultFines = mysqli_query($conn, $updateFines);

                  echo "<h6>Total fines: " . number_format($new_total_fines, 2) . " JD</h6>";

                }

                

  
              }else{
                $show_fines = "SELECT fines FROM users WHERE id='$id'";
                $result_show = mysqli_query($conn, $show_fines);
            
                if (mysqli_num_rows($result_show) > 0) {
                    $rowShow = mysqli_fetch_assoc($result_show);
                    echo "<h6>Total fines: " . number_format($rowShow['fines'], 2) . " JD</h6>";
                    $outside_fines=$rowShow['fines'];
                }
              }
          
              

          }
          


          
  

          
         
        ?>
      </div>

      <div class="container-payment">
  <div class="wrapper-payment">
    <form action='receivables.php' method='POST'>

      <?php
      $each_book = "SELECT end_date, name, book_id FROM library WHERE owend_by='$id'";
      $result_books = mysqli_query($conn, $each_book);

      if ($result_books) {
        while ($found_books = mysqli_fetch_assoc($result_books)) {
          $book_fine = 0;
          $end_date = $found_books['end_date'];
          $book_id = $found_books['book_id'];
          $book_name = $found_books['name'];

          if ($end_date < $today_date) {
            $start = strtotime($today_date);
            $end = strtotime($end_date);
            $diff_seconds = $start - $end;
            $days_difference = floor($diff_seconds / (60 * 60 * 24));
            $book_fine += ($days_difference) * 5.00;
            payment($book_name, $book_fine, $book_id, $id, $conn,$today_date,$userName,$outside_fines);
          } else {
            echo "<h4>{$book_name}</h4>";
            echo "<input type='submit' name='return-book{$book_id}' value='Return'>";
            return_book($book_name, $book_id, $id, $conn);
          }
        }
      }

      function return_book($book_name, $book_id, $id, $conn) {
        if (isset($_POST['return-book' . $book_id])) {
          $remove_userBook = "DELETE FROM user_books WHERE user_id ='$id' AND book_id ='$book_id'";
          $remove_own = "UPDATE library SET owend_by=null, start_date=null, end_date=null WHERE book_id ='$book_id'";

          $query_two = mysqli_query($conn, $remove_userBook);
          $query_three = mysqli_query($conn, $remove_own);

          if ($query_two && $query_three) {
            echo "You returned the book '{$book_name}'.";
          } else {
            echo "Error returning the book '{$book_name}'.";
          }
        }
      }

      function payment($book_name, $book_fine, $book_id, $id, $conn,$today_date,$username,$user_fines) {
        echo "<h4>Your fine for the book '{$book_name}' is: {$book_fine}</h4>";
        echo "<input type='submit' name='pay-book{$book_id}' value='Pay'>";

        if (isset($_POST['pay-book' . $book_id])) {
          $search_fines = "SELECT fines FROM users WHERE id='$id'";
          $query_zero = mysqli_query($conn, $search_fines);
          $resultFines = mysqli_fetch_assoc($query_zero);

          if ($resultFines) {
            $newTotal = $resultFines['fines'] - $book_fine;

            $remove_fines = "UPDATE users SET fines='$newTotal' WHERE id='$id'";
            $remove_userBook = "DELETE FROM user_books WHERE user_id='$id' AND book_id='$book_id'";
            $remove_own = "UPDATE library SET owend_by=null, start_date=null, end_date=null WHERE book_id='$book_id'";

            $query_one = mysqli_query($conn, $remove_fines);
            $query_two = mysqli_query($conn, $remove_userBook);
            $query_three = mysqli_query($conn, $remove_own);

            if ($query_one && $query_two && $query_three) {
              echo "You paid the fine and returned the book '{$book_name}'.";
              //lol
              fines_confirm($book_fine,$book_id,$book_name,$today_date,$username,$id,$user_fines);
            } else {
              echo "Error processing payment for the book '{$book_name}'.";
            }
          }
        }
      }
      ?>

    </form>
  </div>
</div>


    </div>


    
    <script>
      const slides =document.querySelectorAll(".slides li");
      let slideIndex = 0;
      let intervalId= null;

      //initializeSlider();
      document.addEventListener("DOMContentLoaded",initializeSlider);

      function initializeSlider(){
        if(slides.length >0){
          slides[slideIndex].classList.add("displaySlide");
          intervalId = setInterval(nextSlide,5000);

        }
      }
      
      function showSlide(index){

        if(index >= slides.length){
          slideIndex = 0;
        }
        else if(index < 0){
          slideIndex = slides.length -1;
        }

        slides.forEach(slide => {
          slide.classList.remove("displaySlide");
        });
        slides[slideIndex].classList.add("displaySlide");
      }

      function prevSlide(){
        clearInterval(intervalId);
        slideIndex--;
        showSlide(slideIndex);
      }
      function nextSlide(){
        slideIndex++;
        showSlide(slideIndex);
      }
    </script>




  </div>

  </main>

  <div class="foot-vector">
          <img src="/MutasmProject/assets/Receive/foot.svg">
        </div>

          <?php 
    include("footer.html");
  ?>


</body>



</html>



