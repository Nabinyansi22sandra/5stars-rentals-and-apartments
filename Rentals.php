<?php
  require 'config/config.php';
  $data = [];
  
  if(isset($_POST['search'])) {
    // Get data from FORM
    $keywords = $_POST['keywords'];
    $location = $_POST['location'];

    //keywords based search
    $keyword = explode(',', $keywords);
    $concats = "(";
    $numItems = count($keyword);
    $i = 0;
    foreach ($keyword as $key => $value) {
      # code...
      if(++$i === $numItems){
         $concats .= "'".$value."'";
      }else{
        $concats .= "'".$value."',";
      }
    }
    $concats .= ")";
  //end of keywords based search
  
  //location based search
    $locations = explode(',', $location);
    $loc = "(";
    $numItems = count($locations);
    $i = 0;
    foreach ($locations as $key => $value) {
      # code...
      if(++$i === $numItems){
         $loc .= "'".$value."'";
      }else{
        $loc .= "'".$value."',";
      }
    }
    $loc .= ")";

  //end of location based search
    
    try {
      //foreach ($keyword as $key => $value) {
        # code...

        $stmt = $connect->prepare("SELECT * FROM room_rental_registrations_apartment WHERE country IN $concats OR country IN $loc OR state IN $concats OR state IN $loc OR city IN $concats OR city IN $loc OR address IN $concats OR address IN $loc OR rooms IN $concats OR landmark IN $concats OR landmark IN $loc OR rent IN $concats OR deposit IN $concats");
        $stmt->execute();
        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $connect->prepare("SELECT * FROM room_rental_registrations WHERE country IN $concats OR country IN $loc OR state IN $concats OR state IN $loc OR city IN $concats OR city IN $loc OR rooms IN $concats OR address IN $concats OR address IN $loc OR landmark IN $concats OR rent IN $concats OR deposit IN $concats");
        $stmt->execute();
        $data8 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = array_merge($data2, $data8);

    }catch(PDOException $e) {
      $errMsg = $e->getMessage();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentals - 5stars Rentals And Apartment</title>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
       <!-- Bootstrap core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template -->
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

<!-- Custom styles for this template -->
<link href="assets/css/rent.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
            <a class="logo" href="#">
                    <img src="assets/img/Logo.png" width="80px"alt="logo">
                  </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                  <a class="navbar-brand js-scroll-trigger" href="index.php">Home

                          <span class="sr-only">(current)</span>
                        </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="About Us.php">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact us.php">Contact Us</a>
                  </li>
                  <li class="nav-item">
                   
                    <?php 
                    if(empty($_SESSION['username'])){
                      echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./auth/login.php">Login</a>';
                      echo '</li>';
                    }else{
                      echo '<li class="nav-item">';
                       echo '<a class="nav-link" href="./auth/dashboard.php">Home</a>';
                     echo '</li>';
                    }
                  ?>
                  
      
                  <li class="nav-item">
                    <a class="nav-link" href="./auth/register.php">Register</a>
                  </li>
      
                  </li>
                </ul>
              </div>
            </div>
          </nav>   
          <br><br>
          <center><h1></i> <span class="red"> RENTALS </h1></span></center>

            
        <div class="card-deck">
            <div class="card">
              <img src="assets/img/r1.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kyengera</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
            <div class="card">
              <img src="assets/img/r2.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kisasi</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
            <div class="card">
              <img src="assets/img/r3.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Nabweru</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
          </div>
     </div>
     </div>
     </div>
     </div>

     <div class="card-deck">
            <div class="card">
              <img src="assets/img/r4.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Bukoto</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
            <div class="card">
              <img src="assets/img/r5.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kasubi</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
            <div class="card">
              <img src="assets/img/r6.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Mengo</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
          </div>
     </div>
     </div>
     </div>
     </div>
     <div class="card-deck">
            <div class="card">
              <img src="assets/img/r7.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kibuli</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
            <div class="card">
              <img src="assets/img/r8.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kawempe</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
            <div class="card">
              <img src="assets/img/r9.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kulambiro</h5>
                <p class="card-text">Details</p>
                <p class="card-text"><small class="text-muted"></small></p>
              </div>
            </div>
          </div>
     </div>
     </div>
     </div>
     </div>
   
      <!-- Footer -->
    <footer id="footer">
            

            <footer style="background-color: #536399;">
              <div class="container">
                <div class="row">
                  <div class="col-md-4">
                    <span class="copyright">Your Search Is Over</span>
                  </div>
                  <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="fa fa-twitter"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="fa fa-facebook"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="fa fa-linkedin"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </footer>
           
            
            <script src="assets/plugins/jquery/jquery.min.js"></script>
            <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        
            
            <script src="assets/plugins/jquery-easing/jquery.easing.min.js"></script>
        
            
            <script src="assets/js/jqBootstrapValidation.js"></script>
            <script src="assets/js/contact_me.js"></script>
        
            
            <script src="assets/js/rent.js"></script>
</body>
</html>