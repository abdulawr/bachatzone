
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
                    <option value="4">CNIC</option>
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
                    <th>Mobile</th>
                    <th>CNIC</th>
                    <th>Type</th>
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
                    elseif($search_type == 4){
                        $search_dd = " and cnic = $query";
                    }

                  }
                  else{
                      $search_dd = '';
                  }

                
                  $data = DBHelper::get("SELECT * FROM `supplier` where date != '' $search_dd");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                            <tr style="vertical-align: middle;">
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["mobile"]; ?></td>

                                <td><?php echo $row["cnic"]; ?></td>

                                <td><?php 
                                   if($row["sallerType"] == '0'){
                                     echo '<span class="badge badge-info">Online</span>';
                                   }
                                   elseif($row["sallerType"] == '1'){
                                    echo '<span class="badge badge-secondary">Offline</span>';
                                   }
                                ?></td>
                              
                                <td>
                                    <a href="?p=supplier_profile&id=<?php echo $row["id"];?>" title="Delete Investor"><i class="fas fa-user text-success"></i></a>
                                    <a href="?p=add_supplier&ID=<?php echo $row["id"];?>" title="Edit Investor"><i class="fas fa-pencil-alt text-warning"></i></a>
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
    document.getElementById("p_title").innerText = "Seller lists";
</script>





