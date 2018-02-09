$(document).ready(function(){

	$('#login').click(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		if ($.trim(username).length > 0 && $.trim(password).length > 0) {
			$.ajax({
				url:"http://localhost/ajax/index.php/users/index/login",
				method:"POST",
				data:{username:username, password:password},
				cache: false,
				beforeSend:function(){
					$('#login').val("connecting ...");
				},
				success:function(data){
					if (data) {
						//$('body').load('http://localhost/ajax/index.php/users/dashboard').hide().fadeIn(1500);
						window.location.reload('http://localhost/ajax/users/product');

					} else {
						// for shake effect
						var options = {
							distance: '40',
							direction: 'left',
							times: '3'
						}
						$('#box').effect("shake", options, 800);
						$('#login').val("Login");
						$("#err").html("Invalid Credential !!");
					}
				}
			});
		} else {
			var options = {
							distance: '40',
							direction: 'left',
							times: '3'
						}
						$('#box').effect("shake", options, 800);
			$('#err').html("<span>Please enter the username or password!!</span>");
		}
	});
});

$(document).ready(function(){
		$.ajax({
			url:base_url+'index.php/'+user_type+'/'+module+'/'+list_cont_func,
			dataType:"html",
			cache: false,
			success:function(data){
				if (data) {
					$('#list').load('http://localhost/ajax/index.php/users/product/list').hide().fadeIn(1500);
				}
			}
		});	

});

function ajax_load(type,id=false){
			if (id !="") {
				var url = base_url+user_type+'/'+module+'/'+type+'/'+id;
			}else{
				var url = base_url+user_type+'/'+module+'/'+type;
			}
			$('#list').load(url).hide().fadeIn(1500);
			url = '';

}	

function ajax_del(type, id){
	var r = confirm('Are you sure want to delete this item');
	if(r == true){
		$.ajax({
				url:base_url+user_type+'/'+module+'/'+type+'/'+id,
				dataType:"html",
				cache: false,
				success:function(data){
					if (data) {
						$('#list').load('http://localhost/ajax/index.php/users/product/list').hide().fadeIn(1500);
					}
				}
		});	
	}
}

function fetch_select(val, table, name)
{ 
    $.ajax({
        method: 'POST',
        url: base_url+user_type+'/getListByMatch',
        data: {id:val,table:table,name:name},
        cache: false,
        success: function (response) {
  
        	$("#subcategory").html(response); 
        }
    });
}

function form_submit(form_id,type){
		var a = 0;
		var form = $('#'+form_id);
		var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
		var can = '';
		form.find(".required").each(function(){
			var txt = '*required';
            a++;

            var here = $(this);
            if(here.val() == ''){
                if(!here.is('select')){
                    if(here.attr('type') == 'number'){
                        txt = '*Must be a number';
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span style="color: red;" class="label label-danger require_alert" >'
                            +'      '+txt
                            +'  </span>'
                        );
                    }
                } else if(here.is('select')){
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span style="color: red;" class="label label-danger require_alert" >'
                            +'      *Required'
                            +'  </span>'
                        );
                    }

                }
                can = 'no';
                return false;
            }

			if (here.attr('type') == 'email'){
				if(!isValidEmailAddress(here.val())){
					if(here.closest('div').find('.require_alert').length){
	
					} else {
						sound('form_submit_problem');
						here.closest('div').append(''
							+'  <span class="require_alert" >'
							+'      *must_be_a_valid_email_address'
							+'  </span>'
						);
					}
					can = 'no';
				}
			}

			take = '';
		});
		if(can !== 'no'){
			if(type == 'add'){
				var extension = $('#image').val().split('.').pop().toLowerCase();
				if($.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
					alert('Invalid Image format');
					$('#image').val('');
					return false;
				}else{
					$.ajax({
						url: base_url+user_type+'/'+module+'/'+type,
						method: 'POST',
						data: formdata ? formdata : form.serialize(),
						contentType: false,
						processData: false,
						success: function(data){
							alert(data);
							$('#'+form_id)[0].reset();
							$('#list').load('http://localhost/ajax/users/product/list').hide().fadeIn(1000);
						}

					});
				}
			}else if(type == 'edit'){
				var img = $('#image').val();
				if(img == ''){
					$.ajax({
						url: base_url+user_type+'/'+module+'/'+type,
						method: 'POST',
						data: formdata ? formdata : form.serialize(),
						contentType: false,
						processData: false,
						success: function(data){
							alert(data);
							$('#'+form_id)[0].reset();
							$('#list').load('http://localhost/ajax/users/product/list').hide().fadeIn(1000);
						}

					});
				}else{
					var extension = $('#image').val().split('.').pop().toLowerCase();
					if($.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
						alert('Invalid Image format');
						$('#image').val('');
						return false;
					}else{
						$.ajax({
							url: base_url+user_type+'/'+module+'/'+type,
							method: 'POST',
							data: formdata ? formdata : form.serialize(),
							contentType: false,
							processData: false,
							success: function(data){
								alert(data);
								$('#'+form_id)[0].reset();
								$('#list').load('http://localhost/ajax/users/product/list').hide().fadeIn(1000);
							}

						});
					}
				}
			}
		}
}