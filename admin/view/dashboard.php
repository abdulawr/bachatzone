  <!-- Content Wrapper. Contains page content -->
  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
      <div class="rounded p-2 mt-2 bg-white" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
      <table  class="table table-bordered table-hover mt-3 ts_table">
                  <thead>
                  <tr>
                    <th>Order no</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Disount</th>
                    <th>Shipment</th>
                    <th>Total payable</th>
                    <th>Status</th>
                    <th>Payment Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $data = DBHelper::get("SELECT * FROM `orders` WHERE `orderStatus` not in(99,5,4)");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                            <tr style="vertical-align: middle;">
                               <td><?php echo $row["id"]; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                <td><?php echo $row["total"]; ?></td>
                                <td><?php echo $row["disount"]; ?></td>
                                <td><?php echo $row["shipment_charges"]; ?></td>
                                <td><?php echo $row["total_with_disount"]; ?></td>
                                <td>
                                <?php
                                    if ($row["orderStatus"] == '1') {
                                        echo '<span class="badge badge-primary">Placed by customer</span>';
                                    } elseif ($row["orderStatus"] == '2') {
                                        echo '<span class="badge badge-secondary">Under process</span>';
                                    } elseif ($row["orderStatus"] == '3') {
                                        echo '<span class="badge badge-info">Completed by saller</span>';
                                    } elseif ($row["orderStatus"] == '4') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } elseif ($row["orderStatus"] == '5') {
                                        echo '<span class="badge badge-danger">Return by customer</span>';
                                    } ?>
                                </td>
                                <td>
                                <?php
                                    if ($row["payment_Type"] == '1') {
                                        echo '<span class="badge badge-secondary">Jazzcash</span>Bbr>';
                                        if($row["paymentStatus"] == '1'){
                                          echo '<span class="badge badge-success">Amount Paid</span>';
                                        }
                                        else{
                                          echo '<span class="badge badge-success">Amount Pending</span>';
                                        }
                                    } elseif ($row["payment_Type"] == '2') {
                                        echo '<span class="badge badge-warning">Cash on delivery</span>';
                                    }  ?>
                                </td>
                                <td>
                                    <a href="?p=orderDetails&id=<?php echo $row["id"];?>" title="Delete admin"><i class="fas fa-eye text-primary"></i></a>
                                </td>
                            </tr>
                          <?php
                      }
                  }
                  ?>
                  
                  </tbody>
              
                </table>

                </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->

  
<script>
    document.getElementById("p_title").innerText = "Orders";
</script>

