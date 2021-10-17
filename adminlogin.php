<?php 
    
  $host = 'localhost';
  $user = 'root';
  $pass ='';
  $db   = 'vaccination';
  $conn = new mysqli($host, $user, $pass, $db);

if (isset($_POST['log_in'])) {
   $username = $_POST['username'];
   $user_password = $_POST['user_password'];

  if(empty($username)){
    $username_valid = "<p style ='color:#CC3C39;'>Username/Email Required</p>";
   }
   if(empty($user_password)){
    $pass_valid = "<p style ='color:#CC3C39;'>Password Required</p>";
   }

   if(empty($username)||empty($user_password)){
    $valid =  "<p style ='color:#CC3C39;'>All fields are required<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";

   }else{

    $sql_username = "SELECT * FROM admin WHERE Email ='$username'";
    $data = $conn -> query($sql_username);
    $f_data = $data -> fetch_assoc();
    if( $data -> num_rows == 1) {
        
        if($user_password == $f_data['Password']){

            session_start();
            $_SESSION['FirstName'] = $f_data['FirstName'];
            $_SESSION['LastName'] = $f_data['LastName'];
            $_SESSION['child_birthday'] = $f_data['child_birthday'];
            $_SESSION['Email'] = $f_data['Email'];
            $_SESSION['Password'] = $f_data['Password'];
            $_SESSION['Phone'] = $f_data['Phone'];
           
            header("location:adminprofile.php");
        }else{
            $valid =  "<p style ='color:#CC3C39;'>Wrong Password<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
        }

    }else{
        $valid =  "<p style ='color:#CC3C39;'>wrong username<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
    }
   

    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login or Sigin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/all.min.css">
  <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&display=swap" rel="stylesheet">
  <Style>

  /*-------------Bar start--------------*/
.Menu
{
	background: rgb(82, 126, 173);
	text-align: center;
}
.Menu ul
{
	display: inline-flex;
	list-style: none;
	color: #fff;
}

.Menu ul li
{
	width: 130px;
	margin: 10px;
	padding: 10px;
}

.Menu ul li a
{
	text-decoration: none;
	color: #fff;
}
.active,.Menu ul li:hover
{
   background: #234363;
   border-radius: 50px;
}
.Menu .fa
{
	margin-right: 8px;
}
.sub-menu-1
{
	display: none;

}
.Menu ul li:hover .sub-menu-1
{
	display: block;
	position: absolute;
	background: rgb(82, 126, 173);
	margin-top: 15px;
	margin-left: -15px;
	z-index: 2;
}
.Menu ul li:hover .sub-menu-1 ul
{
	display: block;
	margin: 10px;

}
.Menu ul li:hover .sub-menu-1 ul li
{
	width: 150px;
	padding: 10px;
	border-bottom: 1px dotted #fff;
	background: transparent;
	border-radius: 0;
	text-align: left;

}
.Menu ul li:hover .sub-menu-1 ul li:last-child
{
	border-bottom: none;
	
}
.Menu ul li:hover .sub-menu-1 ul li a:hover
{
	color: #b2ff00;
	
}
   /*-------------Bar end..............*/
   .bg-success {
    background-image: url(image/p1.jpg);
    background-repeat: no-repeat;
    background-size: cover;  
    background-color: #212522!important;
}  

  






  </Style>
</head>
<body>

<header class="site-headers">
		<nav>
			
			<div class="Menu">
      <a class="navbar-brand" href="index.html"><h1><p style="color:white">Vaccination Care</p></h1></a>

      
				<ul>
					<li class="active"><a href="index.html"><i class="fa fa-home"></i>Home</a></i></li>
					<li><a href="#"><i class="fa fa-picture-o"></i>Gallary</a>
						<div class="sub-menu-1">
							<ul>

								<li><a href="photos.html">Photos</a></li>
								<li><a href="videos.html">Videos</a></li>
								


							</ul>
							
						</div>



					</li>
					<li><a href="vaccinelistread.php"><i class="fa fa-home"></i>Campaign</a></li>
					<li><a href="about.html"><i class="fa fa-user"></i>About</a></li>
					
					<li><a href="index.html"><i class="fa fa-id-badge"></i>Logout</a>

                        
							
							
						</div>

					</li>
					
				</ul>
			</div>
		</nav>


	</header>
    
</body>
<body class="bg-success">
  <br>
  <div class="container ">
    <div style="width: 420px;" class="card mx-auto mt-5">
      <div class="card-header">
       <center> <h2>Admin Login</h2></center>
      </div>
      <div class="card-body">
      <div class="form">
        <form action="<?php $_SERVER['PHP_SELF']?>" method = "POST">
        <?php

          if (isset($valid)) {
            echo $valid;
          }

        ?>
        <div class="form-group">
          <input  class="form-control" type="text" placeholder="Enter your Email" name="username">
          <?php 

          if (isset($username_valid)) {
            echo $username_valid;
          }

        ?>
        </div>
        <div class="form-group">
          <input  class="form-control" type="password"  placeholder="Password" name="user_password">
          <?php 

          if (isset($pass_valid)) {
            echo $pass_valid;
          }

        ?>
        </div>
        <div class="form-group">
        <input class="btn btn-info" type="submit" value="Log In" name="log_in">
        </div>
        
        <label id="forgotpwd" class="text-right float-right">Registration<a href="adminregistration.php"> Click Here</a></label>
      </form>
    </div>
  </div>
      </div>
    </div>
  <br>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>