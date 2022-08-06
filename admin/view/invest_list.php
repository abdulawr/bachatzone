
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
                    <th>Status</th>
                    <th>CNIC</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                
                  if(isset($_POST["query"]) && isset($_POST["search_type"])){
                     $search_type = $_POST["search_type"];
                     $query = DBHelper::escape($_POST["query"]);
                     
                     if($search_type == 1){
                        $search_dd = " and (fname like '%".$query."%' or lname like '%".$query."%' )";
                     }
                     elseif($search_type == 2){
                        $search_dd = " and mobile like '%".$query."%' ";
                     }
                     elseif($search_type == 3){
                        $search_dd = " and email like '%".$query."%' ";
                    }
                    elseif($search_type == 4){
                        $search_dd = " and cnic = $query";
                    }

                  }
                  else{
                      $search_dd = '';
                  }

                
                  $data = DBHelper::get("SELECT * FROM `investor` where type = '0' $search_dd");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                            <tr style="vertical-align: middle;">
                                <td><?php echo $row["fname"]." ".$row["lname"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["mobile"]; ?></td>
                    

                                <td>
                                    <?php 
                                     if($row["status"] == "0"){
                                      echo '<span class="badge badge-success">Active</span>';
                                     }
                                     else{
                                        echo '<span class="badge badge-danger">Blocked</span>';
                                     }
                                    ?>
                                </td>

                                <td><?php echo $row["cnic"]; ?></td>

                                <td>
                                    <?php 
                                    if($row["gender"] == "1") {
                                        echo "Male";
                                    }
                                    elseif($row["gender"] == "1") {
                                        echo "Female";
                                    }
                                    else{
                                        echo "Other";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row["age"]; ?></td>
                                <td>
                                    <a href="?p=investor_profile&id=<?php echo $row["id"];?>" title="Delete Investor"><i class="fas fa-user text-success"></i></a>
                                    <a href="?p=add_investor&ID=<?php echo $row["id"];?>" title="Edit Investor"><i class="fas fa-pencil-alt text-warning"></i></a>
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
    document.getElementById("p_title").innerText = "Investor List";
</script>





