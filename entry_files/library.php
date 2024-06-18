<?php

session_start();

include("database.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/MutasmProject/css/library.css">
    <title>Library</title>


<?php
  include("header.php");
?>



<body>
<main>
    <div class="head-vector">
        <img src="/MutasmProject/assets/Library/head.svg">
    </div>

    <?php

    $result = mysqli_query($conn, "SELECT * FROM library");

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="wrapper-books">';

        echo "<h2>List of Books</h2>";
        echo "<ul>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><span class='img-inside'><img src='Images/Books/".$row['book_img']."'/></span>";
            echo "<span class='small-box'><span class='text-inside'>" . $row['name'] . "</span>";
            echo "<span class='text-inside'>Genre: " . $row['genre'] . "</span>";
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="book_id" value="' . $row['book_id'] . '">';

            if($row["owend_by"]){
              echo '<span class="text-inside">Not Avalibe</span>';

            }else{      
              $current_date = date('Y-m-d');
              $max_date = date('Y-m-d', strtotime('+1 weeks'));
              echo"<span class='text-inside'>Choose the end date</span>";
              echo '<span class="text-inside"><input type="date" id="date" name="date" min="' . $current_date . '" max="'.$max_date.'" required></span>';
              echo '<span class="text-inside"><input type="submit" name="submit" id="pick" value="pick"></span>';

              
            }
            echo '</form></span></li>';

        }

        echo "</ul>";
        
    } else {
        echo "<span class='text-inside'>No books found in the library.</span>";
    }
    if (isset($_POST['submit'])&&!empty($_POST['date'])) {

        $book_id = $_POST['book_id'];
        $end_date = $_POST['date'];
        $user_id = $_SESSION["id"];
    
        $check_query = mysqli_query($conn, "SELECT * FROM user_books WHERE user_id = $user_id AND book_id = $book_id");
        if (mysqli_num_rows($check_query) > 0) {
            echo "You already own this book.";
        } else {
            $update_query = mysqli_query($conn, "UPDATE library SET owend_by = '$user_id', start_date = NOW(), end_date ='$end_date' WHERE book_id = $book_id");
            if ($update_query) {
                $insert_query = mysqli_query($conn, "INSERT INTO user_books (user_id, book_id) VALUES ($user_id, $book_id)");
                if ($insert_query) {
                    echo "Book picked successfully.";
                } else {
                    echo "Error picking book.";
                }
            } else {
                echo "Error updating availability.";
            }
        }
    }
    echo '</div>';

    mysqli_close($conn);
    ?>
</main>
    <div class="foot-vector">
        <img src="/MutasmProject/assets/Library/foot.svg">
    </div>
    <?php include("footer.html") ?>

</body>


</html>
