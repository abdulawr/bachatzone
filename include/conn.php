<?php
$con=new mysqli("localhost","root","","kashif_project_db");
#$con->query("SET CHARACTER SET utf8");  use when question mark is show in place of letter
if($con->connect_errno)
{
    die("Error occured while connecting with database");
}
?>