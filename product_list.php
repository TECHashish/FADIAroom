
<div class="container" style="color: #fff">
  <table class="table" style="margin-top: 10px">
    <thead>
      <tr>
        <th>id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>subCategory</th>
        <th>price</th>
        <th>Shipping</th>
        <th>Tax</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i=0;
        foreach($product as $row){
        $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><img src="<?php echo base_url('uploads/').$row['image']; ?>" width="50px" height="40px" alt=""></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td><?php echo $row['sub_category']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><?php echo $row['shipping']; ?></td>
        <td><?php echo $row['tax']; ?></td>
        <td><?php echo date('m/d/Y', $row['timestamp']);  ?></td>
        <td><button type="button" class="btn btn-primary" onclick="ajax_load('edit','<?php echo $row['product_id']; ?>'); proceed('to_list');">Edit</button></td>
        <td><button type="button" class="btn btn-success" onclick="ajax_del('del','<?php echo $row['product_id']; ?>');">Delete</button></td>
      </tr>
      <?php } ?>
      
    </tbody>
  </table>
</div>
