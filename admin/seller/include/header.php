<?php
 session_start();
 if(!isset($_SESSION["supplier_login"]) && !isset($_SESSION["data"])){
  header("Location: ../seller_login?msg=expired");
  exit;
 }
 include("../../include/conn.php");
 include("../../include/DBHelper.php");
 include("../../include/Encryption.php");
 include("../../include/HelperFunction.php");
 include("../../mail/sendMail.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bachat Zone</title>

<link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
<link rel="manifest" href="../../images/favicon/site.webmanifest">
<link rel="mask-icon" href="../../images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/flick/jquery-ui.css" />
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">