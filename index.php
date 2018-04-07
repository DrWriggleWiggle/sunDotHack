<!DOCTYPE html>
<html>
<?php require_once("head.php");?>
<head>
</head>
<body>
  <h1>Dr. Wriggle Wiggle</h1>
  <?php
  session_start();
  if (isset($_SESSION['user'])) {
    if (isset($_POST['submit_logout'])) {
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
