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
	  <a class="nav-link" href="dashboard.php">
	    <i class="fa fa-fw fa-dashboard"></i>
	    <span class="dashboard.php">My Calendar</span>
	  </a>
	</li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
  <a class="nav-link" href="dashboard.php">
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
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
          <!-- Calendar -->
          <?php require("calendar.php"); ?>

          <!-- Modal for event creation/edit -->
          <div id="eventModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <h2>Event Editor</h2>
              <form action="index.php" method="post">
                Event Name: <input type="text" name="event_name"><br>
                Starts at: <input type="date" name="start_date"> <input type="time" name="start_time"><br>
                Ends at: <input type="date" name="end_date"> <input type="time" name="end_time"><br>
                Location: <input type="text" name="location"> <br>
                Invitations:<br>
                <?php $friends = getFriends($_SESSION['id']); ?>
                <select name="invite_list[]" size=<?php $num = count($friends); if ($num > 10) {$num = 10;} echo $num; ?> multiple>
                  <?php
                  foreach ($friends as $friend) {
                    echo "<option value='" . $friend['memberId'] . "'>" . $friend['firstName'] . ' ' . $friend['lastName'] . "</option>";
                  }
                  ?>
                </select>
                <input type="submit" name="submit_add_event" value="Add Event">
              </form>
            </div>
          </div>
          <button id="add_event">Add Event</button>
          <script>
            var eModal = document.getElementById("eventModal");
            var addBtn = document.getElementById("add_event");
            var closeBtn = document.getElementsByClassName("close");

            addBtn.onclick = function(){
              eModal.style.display = "block";
            }

            for (var i = 0; i < closeBtn.length; ++i) {
              closeBtn[i].onclick = function(){
                eModal.style.display = "none";
              }
            }

            window.onclick = function(event){
              if(event.target == eModal){
                eModal.style.display = "none";
              }
            }
          </script>
          <?php
          function createEvent() {
            $event_name = $_POST['event_name'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $location = $_POST['location'];
            $invite_list = $_POST['invite_list'];

            $start_date_format = date("Y-m-d H:i:s", strtotime($start_date . ' ' . $start_time));
            $end_date_format = date("Y-m-d H:i:s", strtotime($end_date . ' ' . $end_time));

            // create event
            query("INSERT INTO events (owner, name, startDate, endDate, location)
                   VALUES ('" . $_SESSION['id'] . "', '$event_name', '$start_date_format', '$end_date_format', '$location');
              ");

            $events = getLastRow("events", "eventId");

            // invite people to event
            foreach ($invite_list as $invitee) {
              $test = getTable("actions WHERE member='" . $events['member'] . "' AND event='" . $events['eventId'] . "' AND accepted='" . $events['accepted'] . "'");
              if (count($test) == 0) {
                query(
                  "INSERT INTO actions (member, event, accepted)
                  VALUES ('$invitee', '" . $events['eventId'] . "', '0');"
                );
              }
            }
          }

          if (isset($_POST['submit_add_event'])) {
            createEvent();
            usleep(500000);
            echo "<meta http-equiv=\"refresh\" content=\"0; index.php\">";
          }
          ?>
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
            <a class="btn btn-primary" href="login.html">Logout</a>
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
