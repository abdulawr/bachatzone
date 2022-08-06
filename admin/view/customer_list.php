
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

        <form method="POST">
            <div class="row">
                <div class="col-4">
                <input name="query" required type="text" class="form-control" placeholder="Search here....">
                </div>
                <div class="col-4">
                <select name="search_type" class="form-control">
                    <option value="1">Name</option>
                    <option value="2">Mobile</option>
                    <option value="3">Email</option>
                   
                </select>
                </div>
                <div class="col-4">
                <button type="submit" class="btn btn-info">Search</button>
                </div>
            </div>
        </form>

        <table id="ts_table" class="table table-bordered table-hover mt-3">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Mobile</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                
                  if(isset($_POST["query"]) && isset($_POST["search_type"])){
                     $search_type = $_POST["search_type"];
                     $query = DBHelper::escape($_POST["query"]);
                     
                     if($search_type == 1){
                        $search_dd = " and (name like '%".$query."%')";
                     }
                     elseif($search_type == 2){
                        $search_dd = " and mobile like '%".$query."%' ";
                     }
                     elseif($search_type == 3){
                        $search_dd = " and email like '%".$query."%' ";
                    }

                  }
                  else{
                      $search_dd = '';
                  }

                
                  $data = DBHelper::get("SELECT * FROM `tbl_customer` where date != '' $search_dd");

                  if($data->num_rows > 0){
                      while ($row = $data->fetch_assoc()) {
                          ?>
                            <tr style="vertical-align: middle;">
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row["date"])); ?></td>
                    

                                <td>
                                    <?php
                                     if ($row["profile_status"] == "0") {
                                         echo '<span class="badge badge-warning">Pending</span>';
                                     } else {
                                         echo '<span class="badge badge-success">Complete</span>';
                                     } ?>
                                </td>

                                <td><?php echo $row["mobile"]; ?></td>

                                <td>
                                   
                                    <a href="?p=customer_profile&id=<?php echo $row["id"];?>" title="Delete Investor"><i class="fas fa-user text-success"></i></a>
                                  
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
    document.getElementById("p_title").innerText = "Customer list";
</script>





