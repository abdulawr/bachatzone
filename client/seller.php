<?php include("include/header.php"); ?>
<style>
    .sup_image{
        border: 1px solid grey;
        border-radius: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .sall_typ{
      text-decoration: none;
      color: #005295;
      border: 1px solid #005295;
      border-radius: 5px;
      padding: 6px 15px;
    }

    .sall_typ:hover{
      color: white;
      background-color: #005295;
    }

    .sall_typ_active:hover{
      color: white;
      background-color: #0e6655;
    }

    .sall_typ_active{
      text-decoration: none;
      color: white;
      background-color:  #0e6655;
      border: 1px solid #0e6655;
      border-radius: 5px;
      padding: 6px 15px;
    }


</style>
<body class="animsition">
	
<?php
 include("include/nav.php");
 include("include/cart.php");
 ?>

	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-50">
		<div class="container">
      
    <div class="row justify-content-center">

    <form class="col-md-6 col-sm-12" method="post">
      <div class="form-row">
        <div class="col">
          <input name="search_add" type="text" class="form-control" placeholder="Search by address...">
        </div>
        <button name="search_submit" type="submit" class="btn btn-info">Search</button>
      </div>
    </form>

    </div>
  

    <div class="row justify-content-center" style="margin-top: 14px; margin-bottom:20px">
    <div class="col-md-6 col-sm-12">
         <a class="<?php echo (isset($_GET["type"]) && $_GET["type"] == "on") ? "sall_typ_active" : "sall_typ"; ?>" href="seller?type=on">Online</a>
         <a class="<?php echo (isset($_GET["type"]) && $_GET["type"] == "of") ? "sall_typ_active" : "sall_typ"; ?>" href="seller?type=of">Offline</a>
    </div>
    </div>

   

		    <div class="row justify-content-center">
       
            <?php

            $search = "";
            if(isset($_GET["type"])){
              switch($_GET["type"]){
                case "on":
                  $search .= " and sallerType = 0 ";
                  break;
                case "of":
                  $search .= " and sallerType = 1 ";
                  break;
              }
            }

            if(isset($_POST["search_add"]) && isset($_POST["search_submit"])){
              $search_add = DBHelper::escape($_POST["search_add"]);
              $search .= " and `shop_add` like '%".$search_add."%' ";
            }


            $seller = DBHelper::get("SELECT * FROM `supplier` where email != '' $search order by sallerType asc");

            if($seller->num_rows > 0){
              while($row = $seller->fetch_assoc()){
                  ?>
                 <div class="col-md-3 col-sm-12 mt-3 ml-2 mr-2" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px; text-align:center">
                 <?php
                 if(!empty($row["image"])){
                     echo '<img width="120" height="120" class="sup_image" src="../images/seller/'.$row["image"].'" alt="">';
                 }
                 else{
                     echo '<img width="120" height="120" class="sup_image" src="../images/no-img.jpg" alt="">';
                 }
                 ?>
                 
                 <h6><?php echo $row["name"]; ?>
                 <?php
                if($row["sallerType"] == '0'){
                  echo '<span class="badge badge-info">Online</span>';
                }
                elseif($row["sallerType"] == '1'){
                 echo '<span class="badge badge-secondary">Offline</span>';
                }
                ?>
                </h6>
                
                 <a href="product?seller=<?php echo $row["id"];?>" style="margin-top: 10px; margin-bottom:10px" class="btn btn-outline-info btn-sm">Products</a>
                </div>
                  <?php
              }
            }
            else{
                echo "<h1 style='text-align:center'>No seller found!</h1>";
            }
            
            ?>   
            </div>

		</div>
	</section>	


    <div class="content">
    
    <div class="site-section bg-left-half mb-5">
      <div class="container owl-2-style">
        <div class="owl-carousel owl-2">

          <?php
           $companies = DBHelper::get("SELECT * FROM company");
           if($companies->num_rows > 0){
               while($row = $companies->fetch_assoc()){
                   ?>
                     <div class="media-29101 rounded mt-2 mb-2 ml-2 mr-2" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em; background:white; height:100px; ">
                        <div style="display: grid; place-items: center; height: 100px;">
                        <h3><a href="product?company=<?php echo $row["id"]; ?>"><?php echo ucwords($row["name"]);?></a></h3>
                        </div>
                    </div>
                   <?php
               }
           }
          ?>

        </div>

      </div>
    </div>

  </div>

	

    <?php
   include("include/footer.php");
   include("include/links.php");
    ?>

</body>
</html>