<?php
 include_once ('lib/Session.php');
 include_once ('classes/Chat.php');
 Session::checkSession();
 $chat = new Chat(); 
 
if(isset($_GET['action']) && isset($_GET['action']) == "logout"){
   $logOff = $chat->logOff(Session::get('user_id'));
   Session::destroy();
}
	
								if(isset($_POST['userId']) && isset($_POST['message'])){
								 $userId    = $_POST['userId'];
								 $message = $_POST['message'];
						
							   $addMsg = $chat->insertMessage($userId, $message);
	     
                               }
						
						 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/script.js"></script>
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="assets/css/chat.css" />
<title>FADIAroom</title>

</head>

<body onLoad="loadMsg();">

<div class="container">
    <div class="row">
        <div class="col-md-5" style="margin:0; padding:0; height:auto;">
            <div class="panel panel-primary" >
                <div class="panel-heading">
				
                    
					
					<span class="green"></span>
					<label class="online">
					<marquee behavior="scroll" width="120px;" scrollamount="4">
					<?php
					 $result = $chat->allOnline();
						if($result){
							echo '( '.Session::get('user_name').' )';
						  while($value = $result->fetch_assoc()){
						  if(Session::get('user_name') == $value['fname']){
						     continue;
						  }
							 echo '( '.$value['fname'].' )';
						  }}
		?>			  
					</marquee></label> 					
		
					<a href="?action=logout" style="color:#FFFFFF; text-decoration:none"><span class="glyphicon glyphicon-off" style="float:right;"></span></a>
					
                </div>
                <div class="panel-body" >
                    <ul class="chat">
					
                        <div id="chat1"></div>
						
						 
						
                    </ul>
                </div></div>
                <div class="panel-footer">
                    <div class="input-group" style="padding-right:13px;">
                        <textarea name="message" id="messageBox"   placeholder="Type your message here..." /></textarea>
						<input type="hidden" id="userId" name="userId" value="<?php  echo Session::get('user_id'); ?>" />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-md" id="btn-chat"  name="submit" onClick="sendMessage(); post();">
                                Send</button>
                        </span>
						
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
var audio = new Audio('chat.mp3');
	$('textarea').keypress(
	 function(e){
       if(e.keyCode == 13){
	   	 sendMessage();
	     var msg=$(this).val();
		 $(this).val('');
		 $('.panel-body').scrollTop($('.panel-body')[0].scrollHeight);
		 audio.play();
        }
	});	
	
	$('#btn-chat').click(function(){
	     var msg=$('textarea').val();
		 $('textarea').val('');
		 $('.panel-body').scrollTop($('.panel-body')[0].scrollHeight);
		 audio.play();
     });	  

});
	
</script>
</body>
</html>
