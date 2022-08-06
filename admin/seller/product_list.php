<?php
include("include/header.php");
?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<?php include("include/nav.php"); ?>

<?php include("include/slider.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <section class="content-header" style="padding: 8px 0px;"></section>

    <!-- Main content -->
    <section class="content">

    
      <div class="card">

      <?php
        if(isset($_GET["msg"]) && $_GET["msg"] == "deleted"){
            msg("Product deleted successfully",1);
        }
        elseif(isset($_GET["msg"]) && $_GET["msg"] == "approved"){
            msg("Product approved successfully",1);
        }
        ?>
       
        <div class="card-body">
        <table id="ts_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Add by</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $ID = $_SESSION["data"]["id"];
                  $data = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
                  'cat' FROM `product` left JOIN product_category on product_category.id = categoryID
                  left JOIN supplier on supplier.id = supplierID left join company on company.id = cmpID where supplierID = '{$ID}' and isdelete = 0");
                

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                           $pp = "../../images/product/".$row["main_img"];
                          ?>
                                <tr style="vertical-align: middle;">
                                <td>
                                   <img onclick="fullView('<?php echo $pp; ?>')" width="40" height="40" class="rounded" src="<?php echo $pp; ?>" alt="">
                                </td>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["quantity"]; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>

                                <td><?php echo $row["price"]; ?></td>
                                <td><?php echo ucwords($row["cat"]); ?></td>
                                <td>
                                    <?php 
                                    if($row["status"] == 1){
                                      echo '<span class="badge badge-success">Approved</span>';
                                    }
                                    elseif($row["status"] == 99){
                                        echo '<span class="badge badge-info">Pending</span>';
                                    }
                                    ?>
                                </td>
                                
                                <td>
                                    <?php 
                                    if($row["addedBy"] == 0){
                                      echo '<span class="badge badge-secondary">Admin</span>';
                                    }
                                    elseif($row["addedBy"] == 1){
                                        echo '<span class="badge badge-warning">Seller</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="product_details?ID=<?php echo $row["id"];?>" title="View"><i class="fas fa-eye text-info"></i></a>

                                   
                                    <a href="../seller_action/add_product?ID=<?php echo $row["id"]."&status=".$row["status"];?>&type=delet_prd" title="Delete product"><i class="fas fa-trash text-danger"></i></a>
                                  
                                </td>
                            </tr>
                          <?php
                      }
                  }
                  ?>
                  
                  </tbody>
              
                </table>
        </div>
            
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Product List";
</script>

