
    <!-- Main content -->
    <section class="content mt-2">

      <!-- Default box -->
      <div class="card" style="border-left:4px solid #46775c;">
       
        <div class="card-body">

        <?php
        if(isset($_GET["msg"]) && $_GET["msg"] == "deleted"){
            msg("Product deleted successfully",1);
        }
        elseif(isset($_GET["msg"]) && $_GET["msg"] == "approved"){
            msg("Product approved successfully",1);
        }
        ?>

        <!-- <form method="POST">
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
        </form> -->

        <table id="ts_table" class="table table-bordered table-hover mt-3">
                  <thead>
                  <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Seller</th>
                    <th>Add by</th>
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

                
                  $data = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
                  'cat' FROM `product` INNER JOIN product_category on product_category.id = categoryID
                   INNER JOIN supplier on supplier.id = supplierID inner join company on company.id = cmpID where isdelete = 0 and product.date != ''");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                           $pp = "../images/product/".$row["main_img"];
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
                                <td><?php echo ucwords($row["sup"]); ?></td>
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
                                    <a href="?p=product_details&ID=<?php echo $row["id"];?>" title="View"><i class="fas fa-eye text-info"></i></a>
                                    <a href="?p=add_product&ID=<?php echo $row["id"];?>" title="Edit product"><i class="fas fa-pencil-alt text-warning"></i></a>
                                    <a href="action/add_product?ID=<?php echo $row["id"]."&status=".$row["status"];?>&type=delet_prd" title="Delete product"><i class="fas fa-trash text-danger"></i></a>
                                   
                                    <?php if($row["status"] == 99) { ?>
                                    <a href="action/add_product?ID=<?php echo $row["id"];?>&type=approved_prod" title="Approve product"><i class="fas fa-check text-success"></i></a>
                                    <?php } ?>
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
    document.getElementById("p_title").innerText = "Product lists";
</script>





