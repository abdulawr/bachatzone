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
                    <th>Product no</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>CNIC</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $ID = $_SESSION["data"]["id"];
                  $data = DBHelper::get("SELECT * FROM `buy_now` WHERE `suppID` = '{$ID}'");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                                <tr style="vertical-align: middle;">
                                
                                <td><?php echo $row["prdID"]; ?></td>
                                <td><?php echo $row["cus_name"]; ?></td>
                                <td><?php echo $row["cus_mobile"]; ?></td>
                                <td><?php echo $row["cus_cnic"]; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                <td><?php echo $row["qty"]; ?></td>
                                <td><?php echo $row["price"]; ?></td>
                                <td><?php echo $row["discount"]; ?></td>

                              
                                <td>
                                    <a href="product_details?ID=<?php echo $row["prdID"];?>" title="View product"><i class="fas fa-eye text-info"></i></a>
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
    document.getElementById("p_title").innerText = "Buy now history";
</script>

