<?php
include("include/header.php");
$ID = $_SESSION["data"]["id"];
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
       
        <div class="card-body">

        <?php
        if(isset($_GET["msg"]) && $_GET["msg"] == "del_suc"){
          echo msg("Action perform successfully");
        }
        ?>
        
        <?php
        if ($_SESSION["data"]["sallerType"] == '1') {
          ?>
        <table id="ts_table" class="table table-bordered table-hover mt-3">
                  <thead>
                  <tr>
                    <th>Order no.</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Payable amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php

  $data = DBHelper::get("SELECT buy_now_product.*,product.title,product.main_img 
  FROM `buy_now_product` INNER JOIN
   product on product.id = `prdID` WHERE `suppID` = '{$ID}' and buy_now_product.status = 0 ");


            if ($data->num_rows > 0) {
                while ($row = $data->fetch_assoc()) {
                    $img = $row["main_img"]; ?>
                            <tr style="vertical-align: middle;">
                            <td><?php echo $row["id"]; ?></td>
                                <td onclick="fullView('../../images/product/<?php echo $img; ?>')"><img width="40" height="60" class="img-thumbnail rounded" src="../../images/product/<?php echo $row["main_img"]; ?>" alt=""></td>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo ucwords($row["color"]); ?></td>
                                <td><?php echo $row["size"]; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row["date"])); ?></td>
                                <td><?php echo $row["qty"]; ?></td>
                                <td>Rs. <?php echo $row["customer_payable"]; ?></td>
                              
                                <td>
                                    <a href="buy_now_order_details?ID=<?php echo $row["prdID"]; ?>&ord_listID=<?php echo $row["id"]; ?>" title="View order details"><i class="fas fa-eye text-info"></i></a>
                                </td>
                            </tr>
                          <?php
                }
            } ?>
                  
                  </tbody>
              
                </table>
          <?php
        }
        else{
          if(isset($_GET["msg"]) && $_GET["msg"] == "success"){
            msg("Action perform successfully");
       }
       elseif(isset($_GET["msg"]) && $_GET["msg"] == "error"){
          msg("Something went wrong try again",2);
       }
            ?>

        <table id="ts_table" class="table table-bordered table-hover mt-3">
                  <thead>
                  <tr>
                    <th>Order no</th>
                    <th>Products</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
             
                  $data = DBHelper::get("SELECT DISTINCT(orderID),orderlist.* FROM `orderlist` WHERE `suppID` = '{$ID}' and status not in(5,2)");

            if ($data->num_rows > 0) {
                while ($row = $data->fetch_assoc()) {
                    $rr = DBHelper::get("SELECT COUNT(id) as tot,sum(qty) as t_qty,sum(supplier_amont) as ssval FROM `orderlist` WHERE `suppID` = '{$ID}' and status not in(5,2) and orderID = '{$row["orderID"]}' GROUP by `orderID` limit 1")->fetch_assoc();
                    ?>
                            <tr style="vertical-align: middle;">
                                <td><?php echo $row["orderID"]; ?></td>
                                <td><?php echo $rr["tot"]; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row["date"])); ?></td>
                                <td>Rs. <?php echo $rr["ssval"]; ?></td>
                                <td><?php echo $rr["t_qty"]; ?></td>

                                <td>
                    <?php
                                    if ($row["status"] == '0') {
                                        echo '<span class="badge badge-primary">Pending</span>';
                                    } elseif ($row["status"] == '1') {
                                        echo '<span class="badge badge-secondary">Delivered</span>';
                                    } elseif ($row["status"] == '3') {
                                        echo '<span class="badge badge-info">Received by customer</span>';
                                    } elseif ($row["status"] == '4') {
                                        echo '<span class="badge badge-success">Waiting admin approval</span>';
                                    } elseif ($row["status"] == '5') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    }elseif ($row["status"] == '2') {
                                      echo '<span class="badge badge-danger">Return by customer</span>';
                                  } ?>
                    </td>
                              
                                <td>
                                    <a href="orderDetails?id=<?php echo $row["orderID"]."&status=".$row["status"]; ?>" title="View order details"><i class="fas fa-eye text-info"></i></a>
                                </td>
                            </tr>
                          <?php
                }
            } ?>
                  
                  </tbody>
              
                </table>

                <?php
        } ?>

        </div>
            
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Orders";
</script>

