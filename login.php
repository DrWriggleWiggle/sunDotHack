<!DOCTYPE html>
<html>
<head>
  <?php require_once("head.php");?>
<html lang="en">
<body>
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
      header("Location: http://167.99.168.175/index.php");
    }
    else {
      echo "<script type=\"text/javascript\">
        alert(\"Invalid Login\");
        </script>";
    }
  }
  ?>
  <div class="container">
      <div class="card card-login mx-auto mt-5">
          <div class="card-header">Login</div>
          <div class="card-body">
              <form action="login.php" method="post">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input class="form-control" id="exampleInputEmail1" type="text" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password">
                  </div>
        <input class="btn btn-primary btn-block" name="submit_login" value="Login" type="submit" />
              </form>
              <div class="text-center">
                  <a class="d-block small mt-3" href="register.php">Register an Account</a> <!-- Need to add link -->
              </div>
          </div>
      </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
