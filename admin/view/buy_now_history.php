
    <!-- Main content -->
    <section class="content mt-2">

      <!-- Default box -->
      <div class="card" style="border-left:4px solid #46775c;">
       
        <div class="card-body">

        <form method="POST">
            <div class="row">
                <div class="col-4">
                <input name="query" required type="number" class="form-control" placeholder="Search here....">
                </div>
                <div class="col-4">
                <select name="search_type" class="form-control">
                    <option value="1">Order no</option>
                    <option value="2">Customer id</option>
                    <option value="3">Supper id</option>
                    <option value="4">Product id</option>
                </select>
                </div>
                <div class="col-4">
                <button name="search_order" type="submit" class="btn btn-info">Search</button>
                </div>
            </div>
        </form>


        <table id="ts_table" class="table table-bordered table-hover mt-3">
            <thead>
            <tr>
                <th>Order no</th>
                <th>Customer id</th>
                <th>Product id</th>
                <th>Supplier id</th>
                <th>Quantity</th>
                <th>Color</th>
                <th>Size</th>
                <th title="Saller amount">Sall amount</th>
                <th title="Customer payable">Cust amount</th>
                <th title="Company earnign">Earning</th>
                <th title="Customer discount">Discount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            <?php
            $searh = "";
            if(isset($_POST["search_order"]) && isset($_POST["search_type"])){
                $search_type = $_POST["search_type"];
                $query = $_POST["query"];
                switch($search_type){
                    case 1:
                        $searh = " and id = '{$query}' ";
                        break;
                    case 2:
                        $searh = " and cusID = '{$query}' ";
                        break;
                    case 3:
                        $searh = " and suppID = '{$query}' ";
                        break;
                    case 4:
                        $searh = " and prdID = '{$query}' ";
                        break;
                }
            }
            $data = DBHelper::get("SELECT * FROM `buy_now_product` where status = 1  $searh ");
            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row["id"];?></td>
                        <td><?php echo $row["cusID"];?></td>
                        <td><?php echo $row["prdID"];?></td>
                        <td><?php echo $row["suppID"];?></td>
                        <td><?php echo $row["qty"];?></td>
                        <td><?php echo ucwords($row["color"]);?></td>
                        <td><?php echo $row["size"];?></td>
                        <td>Rs. <?php echo $row["saller_payable"];?></td>
                        <td>Rs. <?php echo $row["customer_payable"];?></td>
                        <td>Rs. <?php echo $row["company_earning"];?></td>
                        <td>Rs. <?php echo $row["discount"];?></td>
                        <td>
                            <span class="badge badge-warning">Completed</span>
                        </td>
                        <td>
                        <a href="?p=customer_profile&id=<?php echo $row["cusID"];?>" title="Customer"><i class="fas fa-user text-info"></i></a>
                        <a href="?p=product_details&ID=<?php echo $row["prdID"];?>" title="View product"><i class="fas fa-eye text-warning"></i></a>
                        <a href="?p=supplier_profile&id=<?php echo $row["suppID"];?>" title="Saller"><i class="fas fa-eraser text-success"></i></a>
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
    document.getElementById("p_title").innerText = "Buy now completed requests";
</script>


