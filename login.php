<?php 
include_once ('classes/UserLogin.php');
$user = new UserLogin(); 
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])){
		 $email    = $_POST['email'];
		 $password = $_POST['password'];
		 if(isset($_POST['remember'])){
		   $remember = $_POST['remember'];
		 } else {
		 	$remember = 0;
		 }
			  
	     $loginChk = $user->UserLoginCheck($email, $password, $remember);
    }
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
		 $fname    = $_POST['fname'];
		 $lname    = $_POST['lname'];
		 $email    = $_POST['email'];
		 $password = $_POST['password'];
		 			  
	     $loginChk = $user->insertUser($fname, $lname, $email, $password);
    }
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['forgot'])){
		 $email    = $_POST['email'];
		 			  
	     $frgtPass = $user->forgotPass($email);
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FADIAroom</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<link rel="stylesheet" href="assets/css/jquery-ui.min.css">


        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>





<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
  
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Password Recover</h2>
    </div>
	
    <div class="modal-body">
      <form action="login.php" method="post">
		  <center>
			  <p style="color:#999999; font-size:18px; margin:0; font-weight:normal;">Enter your Email</p><br>
			  <input type="text" name="email" style="width:80%; height:30px; border:2px solid #94BEBE; color:#999;"><br>
			  <input type="submit" name="forgot" value="Send Mail" style="; margin:10px; background:#0099FF; font-weight:normal; color:#fff; border:0; border-radius:2px; padding:3px 8px; font-size:15px;">
		  </center>
	  </form>
    </div>
	
    <div class="modal-footer">
      <h3></h3>
    </div>
	
  </div>

</div>







        <!-- Top content -->
        <div class="top-content">
        	<div class="container">
                	
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1 style="margin:0">Welcome to FADIAroom</h1>
                        <div class="description">
                        	<p>
	                         	This is simply a discussion forum like other messanger where we continue the <strong>BAKCHODI</strong> !
                        	</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-3 show-forms">
                    	<span class="show-register-form active">Login</span> 
                    	<span class="show-forms-divider">/</span> 
                    	<span class="show-login-form">Register</span>
						<span class="pull-right" style="color:#FF99CC; font-size:16px;"><?php if(isset($loginChk)){ echo $loginChk; } ?></span>
                    </div>
					
                </div>
                
                
                
                <div class="row register-form ">
                    <div class="col-sm-5 col-sm-offset-3">
						<form role="form" action="" method="post" class="l-form">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="l-form-username">Username</label>
	                        	<input type="text" name="email" placeholder="Email..." class="l-form-username form-control" id="l-form-username" value="<?php if(isset($_COOKIE["user"])){echo $_COOKIE["user"];} ?>">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="l-form-password">Password</label>
	                        	<input type="password" name="password" placeholder="Password..." class="l-form-password form-control" id="l-form-password" value="<?php if(isset($_COOKIE["pass"])){echo $_COOKIE["pass"];} ?>">
	                        </div>
							<div class="form-group">
				                <label style="color:#FFFFFF; float:left;font-weight:normal;"><input type="checkbox" checked="checked" name="remember" value="1"> Remember me</label>
								 <label style=" float:right"><a href="#" id="myBtn" style="color:#FFFFFF;font-weight:normal;"> Forgot Password?</a></label>
				            </div>
				            <button type="submit" name="signin" value="5" class="btn">Sign in!</button>
				    	</form>
                    </div>  
                </div>
				
				<div class="row login-form">
                    <div class="col-sm-5 col-sm-offset-3">
						<form role="form" action="" method="post" class="r-form">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="r-form-first-name">First name</label>
	                        	<input type="text" name="fname" placeholder="First name..." class="r-form-first-name form-control" id="r-form-first-name">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="r-form-last-name">Last name</label>
	                        	<input type="text" name="lname" placeholder="Last name..." class="r-form-last-name form-control" id="r-form-last-name">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="r-form-email">Email</label>
	                        	<input type="text" name="email" placeholder="Email..." class="r-form-email form-control" id="r-form-email">
	                        </div>
							
						
	                        							
	                        <div class="form-group">
	                        	<label class="sr-only" for="r-form-email">Password</label>
	                        	<input type="password" name="password" placeholder="Password..." class="r-form-password form-control" id="r-form-email">
	                        </div>
				            <button type="submit" name="register" value="submit" class="btn">Sign me up!</button>
						</form>
                    </div>
                    
                </div>
                    
        	</div>
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-5 col-sm-offset-3">
        				<div class="footer-border"></div>
        				<p>Made by <strong>Ashish</strong>.</p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
<script type="text/javascript">
$(document).ready(function(){ 

 

 // Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
 
// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


});
</script>
    </body>

</html>