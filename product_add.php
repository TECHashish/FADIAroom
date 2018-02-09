<!--background-->
<h1> Product Form</h1>
    <div class="bg-agile">
	<div class="book-appointment">
	<h2>Product Information Add</h2>
			<form id="hospitalForm">
				<div class="left-agileits-w3layouts same">
					<div class="gaps" >
						<p>Product Name</p>
						<input type="text" name="name" placeholder="Product name" class="required"/><br>
						
					</div>	
					<div class="gaps">
						<p>Category</p>	
		                    <select class="form-control required" name="category" id="categorylist"  onchange="fetch_select(this.value, 'subcategory', 'category_id');">
								<option></option>
								<?php
									foreach ($category as $val ) {
								?>
								<option value="<?php echo $val['category_id']; ?>"><?php echo $val['name']; ?></option>
								<?php } ?>
							</select>
					</div>
					<div class="gaps">
						<p>Sub Category</p>	
							<select class="form-control" id="subcategory" name="sub_category" class="required"><br>
								<option></option>
							</select>
							<span id="scatError" style="color:red;"></span>
					</div>		
					<div class="gaps">	
						<p>Price</p>
						<input type="number" name="price" placeholder="price" class="required"/><br>
					</div>
				</div>
				<div class="right-agileinfo same">
					<div class="gaps">	
						<p>Image</p>
						<input type="file" name="image" id="image" placeholder="product image" class="required"/><br>
					</div>
					<div class="gaps">
						<p>Tax</p>
						<input type="number" name="tax" placeholder="Tax" class="required"/><br>
					</div>
					
					<div class="gaps">
						<p>Shipping</p>
						<input type="number" name="shipping" placeholder="Shipping" class="required" /><br>
					</div>
					
				</div>
				<div class="clear"></div>
				<input type="button" id="submitHs" onclick="form_submit('hospitalForm','add');" value="Submit">
			</form>
		</div>
   </div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#subcategory').click(function(){
			var scat = $('#subcategory').val();
			if(scat == ''){
				$('#scatError').text('Please ! select category first.');
			}
		});
	});
</script>

			<!-- //Calendar -->