<!DOCTYPE HTML>
<html>
<head>
<title>Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="<?php echo base_url('templates/css/product/')?>jquery-ui.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url('templates/css/product/')?>pro.css" rel='stylesheet' type='text/css' />
</head>
<body>
	  <h2 style="margin: 20px; color: #fff; font-size: 26px;"><span><a class="btn btn-danger" href="<?php echo base_url('index.php/users/logout'); ?>">logout</a></span>&nbsp; &nbsp; Product List 
	  	<span style="float: right;">
	  		<button type="button" class="btn btn-warning add_pro_btn" onclick="ajax_load('add'); proceed('to_list');">Product Add</button>
	  		<button type="button" class="btn btn-warning pro_list_btn" onclick="ajax_load('list'); proceed('to_add');">Back To Product List</button>
	  </span>
	  </h2>
<div id="list"></div>

</body>
</html>

<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'Users';
	var module = 'product';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	proceed('to_add');
	function proceed(type){
		if(type == 'to_list'){
			$(".pro_list_btn").show();
			$(".add_pro_btn").hide();
		} else if(type == 'to_add'){
			$(".add_pro_btn").show();
			$(".pro_list_btn").hide();
		}
	}
</script>
<script src="<?php echo base_url('templates/js/')?>ajax_method.js"></script>