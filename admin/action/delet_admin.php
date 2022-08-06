<?php
include("include.php");

if(isset($_GET["readMs"])){
 $ID = DBHelper::escape($_GET["id"]);
 DBHelper::set("UPDATE message SET status = 1 WHERE id = {$ID}");
 header("Location: ../?p=messages");
}
else{
    $id = DBHelper::escape($_GET["id"]);
    $data = DBHelper::get("SELECT image FROM `admin` WHERE id = '{$id}'")->fetch_assoc();
    DBHelper::set("DELETE FROM `admin` WHERE id = '{$id}'");
    unlink("../../images/admin/".$data["image"]); ?>
<script>
    location.replace("../?p=admin_list&msg=deleted");
</script>
<?php
}
?>