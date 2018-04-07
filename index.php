<!DOCTYPE html>
<html>
<?php require_once("head.php");?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Social Calendar</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body>
  <h1>Dr. Wriggle Wiggle</h1>
  <?php
  session_start();
  if (isset($_SESSION['user'])) { // if the user is logged in
    if (isset($_POST['submit_logout'])) { // if the user logs out, destroy the session and refresh the page
      session_destroy();
      header("Refresh:0");
    }
    require_once("signed_in.php");
  } else {
    require_once("signed_out.php");
  }
  ?>
</body>
</html>
