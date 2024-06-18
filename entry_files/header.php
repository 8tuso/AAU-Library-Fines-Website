<?php
    


  if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
  }

  if (empty($_SESSION['email'])) {
    
  } 
  else 
  {
    $id = $_SESSION['id'];
    $userEmail = $_SESSION['email'];
    $userName = $_SESSION['name'];

    $majorQuery = "SELECT major from users WHERE id='$id'";
    $result = mysqli_query($conn, $majorQuery);
    $userMajor = mysqli_fetch_assoc($result);
  }
?>

  <link rel="icon" href="/MutasmPROJECT/assets/AAU logo.svg" type="image/svg">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/MutasmProject/css/header.css">
  <link rel="stylesheet" href="/MutasmProject/css/footer.css">
</head>
  <header>
    <div class="warpper">
      <nav class="upper-nav">
        <ul>
          <li><img src="/MutasmPROJECT/assets/AAU logo.svg"/></li>
          <div class="li-wrapper">
          <?php if(isset($_SESSION['email'])): ?>
              <li><a href="home.php">HOME</a></li>
              <li><a href="library.php">LIBRARY</a></li>
              <li><a href="receivables.php">RECEIVABLES</a></li>
          <?php else: ?>
              <li><strong style="color:white"> Worlds, One Book at a Time.</strong></li>
          <?php endif; ?>
            <li><a href="#" class="menu-button" id="menu-button"><img src="/MutasmProject/assets/Bar.svg"/></a>
              <div class="menu-bar" id="menu-bar">
                <ul>
                  <?php if(isset($_SESSION['email'])): ?>
                  <li><a href="#" name="logout" onclick="logout();">Log out</a></li>
                  <?php else: ?>
                    <li><a href="index.php">Log in</a></li>
                    <?php endif; ?>
                  <li><a href="#">Settings</a></li>
                  <li><a href="#">Grades</a></li>
                </ul>
              </div>
            </li> 
          </div>
        </ul>
      </nav>
      <nav class="second-nav">
        <span class="profile-picture">
        <?php if(isset($_SESSION['id'])){
            $result = mysqli_query($conn, "SELECT file_name FROM users WHERE id='$id'");
           
            while($row=mysqli_fetch_assoc($result)){ ?>
        <img src="Images/Profiles/<?php echo $row['file_name'] ?>" />
        <?php } }?>
        
        </span>
        <ul>
          <li>
            <?php if(isset($_SESSION['email'])): ?>
              <a href="profile.php"><?php echo htmlspecialchars($_SESSION["name"]); ?></a>
            <?php else: ?>
              <a href="index.php">Sign in | Log in</a>
            <?php endif; ?>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
  var menuButton = document.getElementById("menu-button");
  var menuBar = document.getElementById("menu-bar");

  menuButton.addEventListener("click", function(event) {
    event.preventDefault();
    menuBar.classList.toggle("menu-open"); // Toggle the 'menu-open' class
  });

  // Optional: Close the menu if clicking outside of it
  document.addEventListener("click", function(event) {
    if (!menuButton.contains(event.target) && !menuBar.contains(event.target)) {
      menuBar.classList.remove("menu-open");
    }
  });
});


    function logout() {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            window.location.href = "index.php";
          } else {
            console.error('Logout request failed:', xhr.status, xhr.statusText);
          }
        }
      };

      xhr.send("logout=1");
    }
  </script>
  

