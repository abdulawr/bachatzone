
    <!-- Main content -->
    <section class="content mt-2">

      <!-- Default box -->
      <div class="card" style="border-left:4px solid #46775c;">
       
        <div class="card-body">

        <?php
        if(isset($_GET["msg"]) && $_GET["msg"] == "deleted"){
            msg("Admin deleted successfully",1);
        }
        ?>

        <table id="ts_table" class="table table-bordered table-hover mt-3">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Suject</th>
                    <th>Message</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php

                  $data = DBHelper::get("SELECT name,email,message.* FROM message INNER JOIN tbl_customer on tbl_customer.id = senderID WHERE status = 0");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                              <tr style="vertical-align: middle;">
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["subject"]; ?></td>
                                <td><?php echo $row["message"]; ?></td>

                                <td>
                                    <a href="action/delet_admin?readMs=read&id=<?php echo $row["id"];?>" title="View message"><i class="fas fa-check text-success"></i></a>
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


<script>
    document.getElementById("p_title").innerText = "Customer messages";
</script>





