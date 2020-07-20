<?php
	require '../config/config.php';
	
	if(isset($_POST['login'])) {

		// Get data from FORM
		$username = $_POST['username'];
		$email = $_POST['username'];
		$password = $_POST['password'];

		try {
			$stmt = $connect->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
			$stmt->execute(array(
				':username' => $username,
				':email' => $email
				));
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			if($data == false){
				$errMsg = "User $username not found.";
			}
			else {
				if(md5($password) == $data['password']) {
					$_SESSION['id'] = $data['id'];
					$_SESSION['username'] = $data['username'];
					$_SESSION['fullname'] = $data['fullname'];
					$_SESSION['role'] = $data['role'];
					header('Location: dashboard.php');
					exit;
				}
				else
					$errMsg = 'Password not match.';
			}
		}
		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}
	}
?>

<?php include '../include/header.php';?>
<html>
<link rel="stylesheet" href="form.css" >
        <script src="form.js"></script>
<body background="../assets/img/8.jpg">
	<!-- Services -->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
      <div class="container">
		<a class="navbar-brand js-scroll-trigger" href="../index.php">
		<a class="logo" href="#">
                    <img src="Logo.png" width="80px"alt="logo">
                  </a>
	</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <!-- <a class="nav-link" href="login.php">Login</a> -->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="services">
		<div class="container">
		<div class="card card-login mx-auto mt-5">
     <div class="card-header"><center><h2>Login</h2></center></div>
     <div class="card-body">
			  	<div class="alert alert-info" role="alert">
			  		<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
					?>
			  		<h3 class="text-center">Please Login</h3>
				    <form action="" method="post">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email Address/User Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="username" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
					  </div>
					  <div class="form-group">
           <div class="form-check">
             <label class="form-check-label">
               <input class="form-check-input" type="checkbox"> Remember Password</label>
           </div>
         </div>
					  <center><button type="submit" class="btn btn-primary" name='login' value="Login">Submit</button></center>
					</form>				 
				 </div>
			</div>
			</div>
		</div>
	</section>
<?php include '../include/footer.php';?>