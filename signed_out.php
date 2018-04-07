<!-- Log in form -->
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form action="signed_out.php" method="post">
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
<!-- -->

<!-- This will be the default page that appears if the user is not signed in -->
<body id="page-top">
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top" id="containerLandingPageText" style="color:white">Social Calendar Application</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="register.php" id="containerLandingPageText" style="color:white">Register</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="signout.php" id="containerLandingPageText" style="color:white">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
        <div class="container" style="padding-top:2em">
            <img class="img-fluid mb-5 d-block mx-auto" src="img/profile.png" alt="">
            <h1 class="text-uppercase mb-0">Social Calendar Company</h1>
            <hr class="star-light">
            <h2 class="font-weight-light mb-0">A new way to connect</h2>
        </div>
    </header>
    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">Say Hello to Your Friends.</h2>
            <hr class="star-light mb-5">
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">In our busy lives, we often find it difficult to connect with others due to conflicting schedules. With the Social Calendar Company, this will no longer be a problem.</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">Sync your calendar to your Social Calendar and book time with your friends. Is your friend busy next Friday night? Send them a request to see a movie Saturday night!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>
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
</body>
