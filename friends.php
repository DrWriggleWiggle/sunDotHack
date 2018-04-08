<!DOCTYPE html>
<html lang="en">

<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    echo "<meta http-equiv=\"refresh\" content=\"0; index.php\">";
  }
 ?>

<head>
  <?php require_once("head.php"); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>My Calendar</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Wriggle Social Calendar</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
	  <a class="nav-link" href="index.php">
	    <i class="fa fa-fw fa-dashboard"></i>
	    <span class="index.php">My Calendar</span>
	  </a>
	</li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
  <a class="nav-link" href="invites.php">
  <i class="fa fa-fw fa-dashboard"></i>
  <span class="invites.php">Invites</span>
  </a>
  </li>
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
	  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
	    <i class="fa fa-fw fa-wrench"></i>
	    <span class="nav-link-text">Friends</span>
	  </a>
	  <ul class="sidenav-second-level collapse" id="collapseComponents">
	    <li>
	      <a href="friends.php">My Friends</a>
	    </li>
	    <li>
	      <a href="addfriends.php">Add Friend</a>
	    </li>
	  </ul>
	</li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <?php
          // reminds the user who is logged in
          $name = $_SESSION['user'];
          echo "<h2>Logged in as $name.</h2>";
          ?>
        </li>
        <li class="nav-item">
          <!-- Logout form -->
          <form action="index.php" method="post">
            <div>
              <input type="submit" name="submit_logout" value="Logout">
            </div>
          </form>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
      <!-- Example DataTables Card-->
          <i class="fa fa-table"></i> My Friends</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Calendar</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>
              <?php
              require_once("sql.php");
              if (isset($_POST['submit_friend_request_remove'])) { // if you hit the remove button, remove the friendship row from the db
                query("DELETE FROM friends WHERE (friend1='" . $_POST['friend'] . "' AND friend2='" . $_SESSION['id'] . "') OR (friend2='" . $_POST['friend'] . "' AND friend1='" . $_SESSION['id'] . "')");
                $friend = getMemberById($_POST['friend']);
                echo "<h5><em>Friendship with " . $friend['firstName'] . " " . $friend['lastName'] . " has been removed.</em></h5>";
              }

              if (isset($_POST['submit_friend_request_cancel'])) { // if you cancelled a friend request you've sent, remove the row from the db
                query("DELETE FROM friends WHERE friend2='" . $_POST['friend2'] . "' AND friend1='" . $_SESSION['id'] . "';");
                $no_friend = getMemberById($_POST['friend2']);
                echo "<h5><em>Friendship request to " . $no_friend['firstName'] . " " . $no_friend['lastName'] . " has been cancelled.</em></h5>";
              }

              // find and display friend requests you have sent
              $friendSubmissions = getTable("friends WHERE friend1='" . $_SESSION['id'] . "' AND accepted='0';");
              foreach ($friendSubmissions as $fs) {
                $member = getMemberById($fs['friend2']);
                echo "<tr><td colspan='5'>";
                echo "Waiting on friend request sent to " . $member['firstName'] . ' ' . $member['lastName'];
                echo "<form action='index.php' method='post'>";
                echo "<div>";
                echo "<input type='hidden' value='" . $member['memberId'] . "' name='friend2'>";
                echo "<input type='submit' value='Cancel' name='submit_friend_request_cancel'>";
                echo "</div>";
                echo "</form>";
                echo "</td></tr>";
              }

                $friends = getFriends($_SESSION['id']);
                foreach ($friends as $f) {
                  echo "<tr>";
                  echo "<td>" . $f['firstName'] . "</td>";
                  echo "<td>" . $f['lastName'] . "</td>";
                  echo "<td>" . $f['email'] . "</td>";
                  echo "<td>";
                  echo "<form action='friend_calendar.php' method='post' target='_blank'><div>";
                  echo "<input type='hidden' value='" . $f['memberId'] . "' name='friend'>";
                  echo "<input type='submit' value='View Schedule' name='submit_view_schedule'></div></form>";
                  echo "</td>";
                  echo "<td>";
                  echo "<form action='friends.php' method='post'><div>";
                  echo "<input type='hidden' value='" . $f['memberId'] . "' name='friend'>";
                  echo "<input type='submit' value='Remove' name='submit_friend_request_remove'></div></form>";
                  echo "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Calendar</th>
                  <th>Remove</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Wriggle Social Calendar Corp 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>
