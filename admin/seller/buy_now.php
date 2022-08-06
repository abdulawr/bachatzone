<?php
include("include/header.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css
">
<style>
 .select2-container .select2-selection--single{
     height: 40px;
 }
</style>
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
        if(isset($_GET["msg"])){
            switch($_GET["msg"]){
                case 'success':
                    msg("Action performed successfull");
                    break;
                    case 'fail':
                        msg("Something went wrong try again");
                        break;
            }
        }
        ?>

<form method="post" action="../seller_action/buy_now">

  <div class="row">

    <div class="col-md-4 col-sm-12">
      <label for=""><b>Name</b></label>
      <input name="name" required type="text" class="form-control" placeholder="Customer name">
    </div>

    <div class="col-md-4 col-sm-12">
    <label for=""><b>Mobile</b></label>
      <input name="mobile" required type="number" class="form-control" placeholder="Customer mobile">
    </div>

    <div class="col-md-4 col-sm-12">
        <label for=""><b>CNIC (optional)</b></label>
      <input name="cnic" type="number" class="form-control" placeholder="Customer cnic">
    </div>

  </div>

  <div class="form-group mt-3">
    <label for="exampleInputPassword1">Select product</label>

    <select  required name="prdID" style="width: 100%;" class="form-control js-example-responsive" id="prdselect" style="height: 46px !important;">
    <option value="">Choose product</option>
    <?php
    $suppID = $_SESSION['data']['id'];
    $product = DBHelper::get("SELECT * FROM `product` WHERE `supplierID` = '{$suppID}'");

    while($row = $product->fetch_assoc()){

           $dis_totLa = 0;
								if(trim($row["wallet_amount_status"]) == "1"){  
									
									if($row["wallet_amount_type"] == "1"){
										// percentage
										$dis_tt = ($row["allow_wallet_per"] / 100) * 70;									
										$dis_tt =  ($row["price"] / 100) * $dis_tt;
															
										$dis_totLa += $dis_tt;
									}
									else{
									// valeu
									$dis_tt = ($row["allow_wallet_per"] / 100) * 70;
									$dis_totLa += $dis_tt;
									}
								}
								else{
									$dis_totLa = 0;
								}

        echo '<option data-price="'.$row["price"].'" data-discount="'. $dis_totLa.'" value="'.$row["id"].'">'.$row["title"].'  [Price: '.$row["price"].']'.'  [Qty: '.$row["quantity"].']'.'</option>';
    }

    ?>
    </select>

  </div>

  <div class="row">
  <div class="form-group mt-3 col-md-4 col-sm-12">
    <label for="exampleInputPassword1">Quantity</label>
    <input name="qty" required value="1" type="number" class="form-control" id="qtyfld">
  </div>

  <div class="form-group mt-3 col-md-4 col-sm-12">
    <label for="exampleInputPassword1">Product price</label>
    <input readonly id="prod_price" name="price" type="number" class="form-control" id="exampleInputPassword1">
  </div>

  <div class="form-group mt-3 col-md-4 col-sm-12">
    <label for="exampleInputPassword1">Discount</label>
    <input readonly name="discount" type="number" class="form-control" id="discount">
  </div>

  </div>
 
  <button type="submit" class="btn btn-info">Submit</button>
</form>


        </div>
            
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Buy now";


    $("#prdselect").change(function(){
       var price =  $('#prdselect option:selected').attr('data-price');
       var discount =  $('#prdselect option:selected').attr('data-discount');
       var pr = price - discount;
       $("#prod_price").val(pr)
       $("#prod_price").attr("data-price",pr)
       $("#discount").val(discount)
    })

    $("#qtyfld").on("keyup",function(){
   
      var pr = $("#prod_price").attr("data-price");
      var qty = $(this).val();
      if ((pr && pr.length !== 0) && (qty && qty.length !== 0)) {
        $("#prod_price").val(pr * qty);
      }
    })

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
  $(function(){
    $("#prdselect").select2({width: 'resolve'});
  })
</script>
