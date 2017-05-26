<?php
 include_once ('lib/Database.php'); 
 include_once ('helpers/Format.php');
?> 
<?php

class Chat{
   private $db;
   private $fm;
   
   public function __construct(){
      $this->db = new Database();
	  $this->fm = new Format();
   }
   
   public function allMsg(){
   	    $query = "select tbl_msg.*, tbl_user.fname, tbl_user.lname, tbl_user.image,tbl_user.id from tbl_msg 
	             inner join tbl_user on tbl_msg.userId = tbl_user.id
	             
	             order by tbl_msg.id asc";
	   $result = $this->db->select($query);
	   return $result;
   }
   public function allOnline(){
   	    $query = "select fname from tbl_user where status='1'";
	    $result = $this->db->select($query);
	    return $result;
   }
   public function insertMessage($userId, $message){
   		 $userId = $this->fm->validation($userId);
	     $message = $this->fm->validation($message);
	  	  
	     $message = mysqli_real_escape_string($this->db->link, $message);
   	   if(!empty($message)){
	      
	      $query  = "insert into tbl_msg(userId, message) values('$userId','$message')";
		  $result = $this->db->insert($query);
		}
   }
    public function logOff($id){
   		$q = "update  tbl_user set status = '0' where id = '".$id."'";
			  $result = $this->db->update($q);
   }

}

?>