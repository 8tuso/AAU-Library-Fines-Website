<?php
      session_start();
  include("database.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/MutasmProject/css/home.css">
  <title>Home</title>



<?php
  include("header.php");
?>

<body>

<main>

  <div class="head-vector">
    <img src="/MutasmProject/assets/Home/head.svg">
  </div>


  <div class="news-wrapper">

    <ul>
      <li><text>DEC<strong>25</strong>2024</text><p>TECHNOLOGY</p><p id="Med">COMPUTER</p><span><img src="/MutasmProject/assets/Home/news1.png"></span></li>
      <li><text>JUN<strong>02</strong>2024</text><p>ART</p><p id="Med">3D</p><span><img src="/MutasmProject/assets/Home/news2.png"></span></li>
      <li><text>SEP<strong>09</strong>2024</text><p>TEACHING</p><p id="Med">MATH</p><span><img src="/MutasmProject/assets/Home/news3.png"></span></li>
      <li><text>OCT<strong>10</strong>2024</text><p>TECHNOLOGY</p><p id="Med">MATH</p><span><img src="/MutasmProject/assets/Home/news4.png"></span></li>
    </ul>

  </div>


  <div class="splitter">
  <ul>
    <li><img src="/MutasmProject/assets/Home/logo1.svg"></li>
    <li><img src="/MutasmProject/assets/Home/logo2.svg"></li>
    <li><img src="/MutasmProject/assets/Home/logo3.svg"></li>
    <li><img id="last-img" src="/MutasmProject/assets/Home/logo4.svg"></li>
  </ul>
    <h2>You Dream<br>To Know More?</h2>
    <hr>
  </div>


  <!--<div class="more-news">
      <div class="inside-news">
          <ul>
            <li>
                <div class="facts-news">
                  <div class="container">
                    <span class="date">DEC
                      <strong>24</strong>
                      2024
                    </span>
                    <span class="facts"><p>SCIENCE</p>  <p>MEDICINE</p></span>
                  </div>
                </div>
                    
            <span id="big-span"><img id="big-picture" src="/MutasmProject/assets/Home/news1.png"></span>
          
          </li>


            <li>

                <div class="facts-news2">
                      <div class="container2">
                        <span class="date2">DEC
                          <strong>24</strong>
                          2024
                        </span>
                        <span class="facts2"><p>SCIENCE</p>  <p>MEDICINE</p></span>
                      </div>
                    </div>
              
            
            
            <span>
              
              <img src="/MutasmProject/assets/Home/news1.png"></span></li>



            <li>
            <div class="facts-news2">
                      <div class="container2">
                        <span class="date2">DEC
                          <strong>24</strong>
                          2024
                        </span>
                        <span class="facts2"><p>SCIENCE</p>  <p>MEDICINE</p></span>
                      </div>
                    </div>
              <span><img src="/MutasmProject/assets/Home/news1.png"></span></li>


            <li>
            <div class="facts-news2">
                      <div class="container2">
                        <span class="date2">DEC
                          <strong>24</strong>
                          2024
                        </span>
                        <span class="facts2"><p>SCIENCE</p>  <p>MEDICINE</p></span>
                      </div>
                    </div><span><img src="/MutasmProject/assets/Home/news1.png"></span></li>

            <li>
            <div class="facts-news2">
                      <div class="container2">
                        <span class="date2">DEC
                          <strong>24</strong>
                          2024
                        </span>
                        <span class="facts2"><p>SCIENCE</p>  <p>MEDICINE</p></span>
                      </div>
                    </div><span><img src="/MutasmProject/assets/Home/news1.png"></span></li>
          </ul>
      </div>
  </div>
-->
</main>

  <div class="foot-vector">
    <img src="/MutasmProject/assets/Home/foot.svg">
  </div>

</body>



<?php include("footer.html"); ?>