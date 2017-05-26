<?php
 include_once ('lib/Session.php');
 Session::checkLogin();
 include_once ('lib/Database.php'); 
 include_once ('helpers/Format.php');
?> 
<?php

class UserLogin{
   private $db;
   private $fm;
   
   public function __construct(){
      $this->db = new Database();
	  $this->fm = new Format();
   }
   
   public function UserLoginCheck($email, $password, $remember){
      $email    = $this->fm->validation($email);
	  $password = $this->fm->validation($password);
	  
	  $email    = mysqli_real_escape_string($this->db->link, $email);
	  $password = mysqli_real_escape_string($this->db->link, $password);
	  
	  if(empty($email) || empty($password)){
	      $loginMsg = 'Username or Password should not be empty !!';
		  return $loginMsg;
	  } else {
	      $query  = "select * from tbl_user where email='".$email."' and password='".$password."'";
		  $result = $this->db->adminSelect($query);
		  if($result != false){
		  	  if($remember = 1)
				{
					setcookie("user", $email, time() + (10 * 365 * 24 * 60 * 60));
					setcookie("pass", $password, time() + (10 * 365 * 24 * 60 * 60));
				}
		      $value = $result->fetch_assoc();
			  $q = "update  tbl_user set status = '1' where id = '".$value['id']."'";
			  $result = $this->db->update($q);
			  
			  Session::set("user_login", true);
			  Session::set("user_id", $value['id']);
			  Session::set("user_name", $value['fname']);
			  Session::set("user_email", $value['email']);
		      header("Location:index.php");
		  } else {
			  $loginMsg = 'Username or Password does not match !!';
			  return $loginMsg;
		  } 
		  
	  }
   }
   

   
   public function insertUser($fname, $lname, $email, $password){
   	  $fname    = $this->fm->validation($fname);
	  $lname    = $this->fm->validation($lname);
      $email    = $this->fm->validation($email);
	  $password = $this->fm->validation($password);
	  
	  $fname    = mysqli_real_escape_string($this->db->link, $fname);
	  $lname    = mysqli_real_escape_string($this->db->link, $lname);
	  $email    = mysqli_real_escape_string($this->db->link, $email);
	  $password = mysqli_real_escape_string($this->db->link, $password);
	  
	  
	  if(empty($fname) || empty($lname) || empty($email) || empty($password)){
	      $loginMsg = 'Field should not be empty !!';
		  return $loginMsg;
	  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			     echo "<script>alert('Invalid Email Id !!');</script>";
	  } else {
	  		$query = "insert into tbl_user(fname, lname, email, password, image) 
		values('$fname', '$lname', '$email', '$password', 'uploads/user.png')";
	  $result = $this->db->insert($query);
		    if($result != false){
				$emailFrom='kumar.ashish2103@gmail.com';
				$subject = 'FADIAroom';
				 
				$headers = 'From:'. $emailFrom . "\r\n"; 
				$headers .= 'Cc:'. $emailFrom . "\r\n";
				$headers .='MIME-Version: 1.0'.'\r\n';
				$headers .='Content-Type:text/html;charset=UTF-8'.'\r\n';
				 
				 
				 
				$message = '
				 
				Dear '.$fname.',
				Thank you for being our valued member to FADIAroom.
				your userName: '.$email.'
				your password : '.$password.'
				I look forward to talking to you more soon.Please do not hesitate to contact me,should you have any further queries.
				visit our website : ashishkumar.netai.net
				enjoy your day !!
				 
				Kind regards,
				FADIAroom team
				';
				 
				 
				$message = wordwrap($message, 70);
				mail($email, $subject, $message, $headers);
			    $msg = "<span class='error'>Registration is successful, Now Login here !!</span>";
			    return $msg;
		    } else {
			    $msg = "<span class='error'>Registration is not successful !!</span>";
			    return $msg;
		   }
      }
   }
   
   public function forgotPass($email){
   	  $email = $this->fm->validation($email);
	  $email = mysqli_real_escape_string($this->db->link, $email);
	  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		  echo "<script>alert('Invalid Email Id !!');</script>";
	  } else {
	  	  $mailquery    = "select * from tbl_user where email = '$email' limit 1";
		  $mailcheck    = $this->db->select($mailquery);
		  if($mailcheck != false){
		    while($value = $mailcheck->fetch_assoc()){
				$userName  = $value['fname'];
			    $userEmail = $value['email'];
			    $userPass  = $value['password'];
				}
			    $emailFrom='kumar.ashish2103@gmail.com';
				$subject = 'Your Recover Password';
				 
				$headers = 'From:'. $emailFrom . "\r\n"; 
				$headers .= 'Cc:'. $emailFrom . "\r\n";
				$headers .='MIME-Version: 1.0'.'\r\n';
				$headers .='Content-Type:text/html;charset=UTF-8'.'\r\n';
				 
				 
				 
				$message = '
				 
				Dear '.$userName.',
				Thank you for being our valued member to FADIAroom.
				your id: '.$userEmail.'
				your password : '.$userPass.'
				Please do not hesitate to contact me,should you have any further queries.
				visit our website : ashishkumar.netai.net
				enjoy your day !!
				 
				Kind regards,
				FADIAroom team
				';
				 
				 
				$message = wordwrap($message, 70);
				$sendmail = mail($email, $subject, $message, $headers);
				if($sendmail){
					echo"<script>alert('Please check your email for password recovery!!.');</script>";
				   } else {
					echo"<script>alert('Email Not Send || Try again !!');</script>";
				   }
			} else {
				echo"<script>alert('This Email does not Exist in our Database !!.');</script>";
			}
	   
	  }
	  
   }

}

?>