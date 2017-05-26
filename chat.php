<?php
 include_once ('lib/Session.php');
 include_once ('classes/Chat.php');
 include_once ('helpers/Format.php');
 Session::checkSession();
 
$allmsg = new Chat(); 
$fm     = new Format();
$result = $allmsg->allMsg();
if($result){
  while($value = $result->fetch_assoc()){
	 
?>
<?php if($value['userId'] != Session::get('user_id')){?>
	              <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="<?php echo $value['image']; ?>" alt="" class="user_photo" width="100%" height="100%"/>
                        </span>
                            <div class="chat-body friend clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $value['fname'];?> <?php echo $value['lname']; ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span><?php echo $fm->formatDate($value['date']); ?></small>
                                </div>
                                <p style="font-family:cursive">
                                    <?php echo $value['message']; ?> 
                                </p>
                            </div>
                        </li>
					<?php } else {?>	
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="<?php echo $value['image']; ?>" alt="User Avatar" class="user_photo" width="100%" height="100%"/>
                        </span>
                            <div class="chat-body self clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo $fm->formatDate($value['date']); ?></small>
                                    <strong class="pull-right primary-font"><?php echo $value['fname'];?> <?php echo $value['lname']; ?></strong>
                                </div>
                                <p style="font-family:cursive;">
                                    <?php echo $value['message']; ?> 
                                </p>
                            </div>
                        </li>
					<?php } ?>	
      
	  <?php }} ?>

   
