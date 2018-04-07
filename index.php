<!DOCTYPE html>
<html>
<head>
  <?php require_once("head.php");?>
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
