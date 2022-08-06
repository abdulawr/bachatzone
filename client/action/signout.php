<?php
unset($_COOKIE['cusID']); 
setcookie('cusID', null, -1, '/'); 
setcookie('t1', null, -1, '/'); 
setcookie('t2', null, -1, '/'); 
header("Location: ../../login");
?>