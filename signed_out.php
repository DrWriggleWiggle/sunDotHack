<!-- Log in form -->
<!-- This will be the default page that appears if the user is not signed in -->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input class="form-control" id="exampleInputEmail1" type="text" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password">
                    </div>
                    <input class="btn btn-primary btn-block" name="submit_login" value="Login" type="submit">
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

<?php
				require_once("sql.php");
				if (isset($_POST['submit_login'])) { // if an attempt to log in has been made, verify. Refresh the page or throw an error message
					$email = $_POST['email'];
					$password = $_POST['password'];
					$verify_login = query("SELECT * FROM members WHERE email='$email' AND password=SHA('$password')");
					if ($row = mysqli_fetch_assoc($verify_login)) {
						$_SESSION['user'] = $row['firstName'] . ' ' . $row['lastName'];
						header("Refresh:0");
					}
					else {
						echo "<script type=\"text/javascript\">
							alert(\"Invalid Login\");
							</script>";
					}
				}
?>
</html>