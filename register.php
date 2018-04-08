<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Register</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register a Social Calendar Account</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label>First name</label>
                <input class="form-control" type="text" name="firstName">
              </div>
              <div class="col-md-6">
                <label >Last name</label>
                <input class="form-control" type="text" name="lastName">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Email address</label>
            <input class="form-control" type="text" name="email">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" type="password" name="password">
              </div>
            </div>
          </div>
          <input class="btn btn-primary btn-block" name="submit_register" type="submit" value="Create Account">
        </form>
	  	<div class="text-center">
	  		<a class="d-block small mt-3" href="signed_out.php">Login</a>
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
<?php
			require_once("sql.php");
			if (isset($_POST['submit_register'])) { // if a registration has been submitted, create account and refresh
				$first_name = $_POST["firstName"];
				$last_name = $_POST["lastName"];
				$email = $_POST["email"];
				$password = $_POST["password"];
				query(
				"INSERT INTO members (firstName, lastName, email, password)
				VALUES ('$first_name', '$last_name', '$email', SHA('$password'));
				");
				echo "<meta http-equiv=\"refresh\" content=\"0; index.php\">";
			}
?>
</html>
