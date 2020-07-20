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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us - 5stars Rentals And Apartment</title>
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="assets/css/rent.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
       <link rel="stylesheet" href="form.css" >
        <script src="form.js"></script>
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
<link href="style.css" rel="stylesheet">

    </head>
    <body background="assets/img/8.jpg">
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
                    <a class="nav-link" href="#">Contact Us</a>
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
          <br><br><br><br>   
          <div class="container">
            <div id="form-main">
                <div id="form-div">
                    <form class="montform" id="reused_form" >
                        <p class="name">
                            <input name="name" type="text" class="feedback-input" required placeholder="Name" id="name" />
                        </p>
                        <p class="email">
                            <input name="email" type="email" required class="feedback-input" id="email" placeholder="Email" />
                        </p>
                        <p class="text">
                            <textarea name="message" class="feedback-input" id="comment" placeholder="Message"></textarea>
                        </p>
                        <div class="submit">
                            <button type="submit" class="button-blue">SUBMIT</button>
                            <div class="ease"></div>
                        </div>
                    </form>
                    <div id="error_message" style="width:100%; height:100%; display:none; ">
                        <h4>
                            Error
                        </h4>
                        Sorry there was an error sending your form. 
                    </div>
                    <div id="success_message" style="width:100%; height:100%; display:none; "> 
                        <h2>Success! Your Message was Sent Successfully.</h2> 
                    </div>
                </div>
            </div>
        </div>
                  </div>
                  <br><br><br><br><br><br><br><br><br><br>
                  <br><br><br><br><br><br><br><br><br><br>
                  <br><br><br><br><br><br><br><br><br><br>
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