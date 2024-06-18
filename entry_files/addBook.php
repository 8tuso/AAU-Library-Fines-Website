<?php
  include("database.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <form action="addbook.php" method="POST" enctype="multipart/form-data">
    <h3>Adding a Book</h3>
    Book Name:<br>
    <input type="text" id="book-name" name="book-name" required><br><br>
    Genre:<br>
    <input type="text" id="book-genre" name="book-genre" required><br><br>
    <input type="file" name="image" required><br><br>
    <input type="submit" id="submit-book" name="submit-book" value="Add Book">
  </form>
</body>
</html>

<?php
if (isset($_POST['submit-book'])) {
  $book_name = $_POST['book-name'];
  $book_genre = $_POST['book-genre'];

  // File upload
  $file_name = $_FILES['image']['name'];
  $tempname = $_FILES['image']['tmp_name'];
  $folder = "Images/Books/" . $file_name;

  // Check if the file is uploaded
  if (move_uploaded_file($tempname, $folder)) {
    echo "<h2>File uploaded Successfully</h2>";

    // Insert book details into the database
    $addBookQuery = $conn->prepare("INSERT INTO library (name, genre, book_img) VALUES (?, ?, ?)");
    $addBookQuery->bind_param("sss", $book_name, $book_genre, $file_name);

    if ($addBookQuery->execute()) {
      echo "<h2>Book added successfully</h2>";
    } else {
      echo "<h2>Error adding book</h2>";
    }
  } else {
    echo "File didn't upload";
  }
}
?>
