
    <!-- Main content -->
    <section class="content mt-2">

      <!-- Default box -->
      <div class="card" style="border-left:4px solid #46775c;">
       
        <div class="card-body">

        <form method="POST">
            <div class="row">
                <div class="col-4">
                <input name="query" required type="number" class="form-control" placeholder="Enter supplier id....">
                </div>
                <div class="col-4">
                <button name="search_order" type="submit" class="btn btn-info">Search</button>
                </div>
            </div>
        </form>


        <table id="ts_table" class="table table-bordered table-hover mt-3">
            <thead>
            <tr>
                <th>Saller payable</th>
                <th>Seller id</th>
                <th>Seller profile</th>
            </tr>
            </thead>

            <tbody>

            <?php
            if(isset($_POST["query"]) && isset($_POST["search_order"])){
             $suppID = $_POST["query"];
             $data = DBHelper::get("SELECT * FROM `buy_now_saller_account` WHERE amount > 0 and sallID = '{$suppID}'");
            }
            else{
                $data = DBHelper::get("SELECT * FROM `buy_now_saller_account` WHERE amount > 0");
            }
           
            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
                    ?>
                    <tr>
                        <td>Rs. <?php echo $row["amount"];?></td>
                        <td><?php echo $row["sallID"];?></td>
                        <td>
                        <a href="?p=supplier_profile&id=<?php echo $row["sallID"];?>" title="Saller"><i class="fas fa-user text-success"></i></a>
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
    document.getElementById("p_title").innerText = "Company earning";
</script>


