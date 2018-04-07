<!-- Log in form -->
<h2>Sign In</h2>
<form action="index.php" method="post">
  <div>
    <label>E-mail</label> <input type="text" name="email"> <br>
    <label>Password</label> <input type="password" name="password"> <br>
    <input type="submit" name="submit_login" value="Login">
  </div>
</form>
<!-- -->

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
  } else {
    echo "<h3><em>Invalid Login</em></h3>";
  }
} else if (isset($_POST['submit_register'])) { // if a registration has been submitted, create account adn refresh
  $first_name = $_POST["firstName"];
  $last_name = $_POST["lastName"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  query(
    "INSERT INTO members (firstName, lastName, email, password)
    VALUES ('$first_name', '$last_name', '$email', SHA('$password'));
    "
  );
  header("Refresh:0");
}
?>

<!-- Registration Form -->
<h2>...Or Create an Account!</h2>
<form action="index.php" method="post">
  <div>
    <label>First Name</label> <input type="text" name="firstName"> <br>
    <label>Last Name</label> <input type="text" name="lastName"> <br>
    <label>E-mail</label> <input type="text" name="email"> <br>
    <label>Password</label> <input type="password" name="password"> <br>
    <input type="submit" name="submit_register" value="Create Account">
  </div>
</form>
<!-- -->
