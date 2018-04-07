<!DOCTYPE html>
<html>
<head>
  <?php require_once("head.php");?>
<html lang="en">
<?php
session_start();

<?php
require_once("sql.php");
if (isset($_POST['submit_login'])) { // if an attempt to log in has been made, verify. Refresh the page or throw an error message
  $email = $_POST['email'];
  $password = $_POST['password'];
  $verify_login = query("SELECT * FROM members WHERE email='$email' AND password=SHA('$password')");
  if ($row = mysqli_fetch_assoc($verify_login)) {
    $_SESSION['user'] = $row['firstName'] . ' ' . $row['lastName'];
    $_SESSION['id'] = $row['memberId'];
    $_SESSION['email'] = $row['email'];
    header("Refresh:0");

  }
  else {
    echo "<script type=\"text/javascript\">
      alert(\"Invalid Login\");
      </script>";
  }
}
?>

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
</html>
