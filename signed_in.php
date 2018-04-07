<?php
// reminds the user who is logged in
$name = $_SESSION['user'];
echo "<h2>Logged in as $name.</h2>";
?>

<!-- Style sheet for modal form -->
<style>
.modal{
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: grba(0,0,0,0.4);
  color: black;
}

.modal-content{
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
</style>

<!-- Logout form -->
<form action="index.php" method="post">
  <div>
    <input type="submit" name="submit_logout" value="Logout">
  </div>
</form>
<!-- -->

<div>
  <h3>Friends</h3>
  <h4>Requests</h4>
  <?php
  require_once("sql.php");
  if (isset($_POST['submit_friend_request'])) { // if the user just submitted a friend request
    $friend1 = $_SESSION['id'];
    $friend2 = -1;
    $result = getTable("members WHERE email='" . $_POST['email'] . "'"); // look for account with requested e-mail
    if (count($result) == 0) {
      echo "<h5><em>Cannot find user with email " . $_POST['email'] . "</em></h5>";
    } else {
      $member = $result[0];
      $friend2 = $member['memberId'];
      if ($member['memberId'] == $_SESSION['id']) { // if requested e-mail is from signed-in account, throw an error message
        echo "<h5><em>Cannot send a friend request to yourself</em></h5>";
      } else {
        // if a friendship or request is already present in the database, throw an error message
        $test = getTable("friends WHERE (friend1='" . $_SESSION['id'] . "' AND friend2='$friend2') OR (friend2='" . $_SESSION['id'] . "' AND friend1='$friend2');");
        if (count($test) > 0) {
          echo "<h5><em>Friendship already going on.</em></h5>";
        } else {
          // adds request to database
          query(
            "INSERT INTO friends (friend1, friend2, accepted)
            VALUES ('$friend1', '$friend2', '0');"
          );
          echo "<h5><em>Friendship requested from " . $member['firstName'] . ' ' . $member['lastName'] . "</em></h5>";
        }
      }
    }
  }

  if (isset($_POST['submit_friend_request_accept'])) { // if a friend request is ACCEPTED, set accepted to 1
    query(
      "UPDATE friends SET accepted='1'
      WHERE friend1='" . $_POST['friend1'] . "' AND friend2='" . $_SESSION['id'] . "';
      "
    );
  } else if (isset($_POST['submit_friend_request_reject'])) { // if a friend request is REJECTED, remove the row in the db
    query(
      "DELETE FROM friends
      WHERE friend1='" . $_POST['friend1'] . "' AND friend2='" . $_SESSION['id'] . "';
      "
    );
  } else if (isset($_POST['submit_friend_request_cancel'])) { // if you cancelled a friend request you've sent, remove the row from the db
    query("DELETE FROM friends WHERE friend2='" . $_POST['friend2'] . "' AND friend1='" . $_SESSION['id'] . "';");
    $no_friend = getMemberById($_POST['friend2']);
    echo "<h5><em>Friendship request to " . $no_friend['firstName'] . " " . $no_friend['lastName'] . " has been cancelled.</em></h5>";
  }

  // find and display friend requests you have sent
  $friendSubmissions = getTable("friends WHERE friend1='" . $_SESSION['id'] . "' AND accepted='0';");
  foreach ($friendSubmissions as $fs) {
    $member = getMemberById($fs['friend2']);
    echo "<li>";
    echo "Waiting on friend request sent to " . $member['firstName'] . ' ' . $member['lastName'];
    echo "<form action='index.php' method='post'>";
    echo "<div>";
    echo "<input type='hidden' value='" . $member['memberId'] . "' name='friend2'>";
    echo "<input type='submit' value='Cancel' name='submit_friend_request_cancel'>";
    echo "</div>";
    echo "</form>";
    echo "</li>";
  }

  // find and display friend requests sent to you
  $friendRequests = getTable("friends WHERE friend2='" . $_SESSION['id'] . "' AND accepted='0';");
  foreach ($friendRequests as $fr) {
    $member = getMemberById($fr['friend1']);
    echo "<li>";
    echo "Friend request sent from " . $member['firstName'] . ' ' . $member['lastName'];
    echo "<form action='index.php' method='post'>";
    echo "<div>";
    echo "<input type='hidden' value='" . $member['memberId'] . "' name='friend1'>";
    echo "<input type='submit' value='Accept' name='submit_friend_request_accept'>";
    echo "<input type='submit' value='Reject' name='submit_friend_request_reject'>";
    echo "</div>";
    echo "</form>";
    echo "</li>";
  }
  ?>
  <ul>
  </ul>
  <h4>Friends</h4>
  <ul>
    <?php
    if (isset($_POST['submit_friend_request_remove'])) { // if you hit the remove button, remove the friendship row from the db
      query("DELETE FROM friends WHERE (friend1='" . $_POST['friend'] . "' AND friend2='" . $_SESSION['id'] . "') OR (friend2='" . $_POST['friend'] . "' AND friend1='" . $_SESSION['id'] . "')");
      $friend = getMemberById($_POST['friend']);
      echo "<h5><em>Friendship with " . $friend['firstName'] . " " . $friend['lastName'] . " has been removed.</em></h5>";
    }

    // find and display your friends
    $friends = getFriends($_SESSION['id']);
    foreach ($friends as $f) {
      echo "<li>";
      echo "You are friends with " . $f['firstName'] . ' ' . $f['lastName'];
      echo "<form action='index.php' method='post'>";
      echo "<div>";
      echo "<input type='hidden' value='" . $f['memberId'] . "' name='friend'>";
      echo "<input type='submit' value='Remove' name='submit_friend_request_remove'>";
      echo "</div>";
      echo "</form>";
      echo "</li>";
    }
    ?>
  </ul>

  <!-- Friendship Request Form -->
  <h4>Send Friend Request</h4>
  <form action="index.php" method="post">
    <label>E-mail</label> <input type="text" name="email"> <br>
    <input type="submit" name="submit_friend_request" value="Request Friendship">
  </form>
  <!-- -->

  <?php require_once("calendar.php"); ?>

  <!-- Modal for event creation/edit -->
  <div id="eventModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Event Editor</h2>
      <form>
        Event Name: <input type="text" name="event_name"><br>
        Starts at: <input type="date" name="start_date"> <input type="time" name="start_time"><br>
        Ends at: <input type="date" name="end_date"> <input type="time" name="end_time"><br>
        Location: <input type="text" name="location"> <br>
        Invitations:<br>
        <?php $friends = getFriends($_SESSION['id']); ?>
        <select name="invite_list" size=<?php echo count($friends); ?> multiple>
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

    // create event
    query("INSERT INTO events (owner, name, startDate, endDate, location)
           VALUES ('" . $_SESSION['id'] . "', '$event_name', '$start_date $start_time', '$end_date $end_time', '$location');
      ");

    $event = getLastRow("events");

    // invite people to event
    foreach ($invite_list as $invitee) {
      $test = getTable("actions WHERE member='" . $events['member'] . "' AND event='" . $events['event'] . "' AND accepted='" . $events['accepted'] . "'");
      if (count($test) == 0) {
        query(
          "INSERT INTO actions (member, event, accepted)
          VALUES ('$invitee', '" . $events['eventId'] . "', '0');"
        );
      }
    }
  }

  if ($_POST['submit_add_event']) {
    createEvent();
  }

  if ($_POST['submit_edit_event']) {
    createEvent();
  }
  ?>
</div>
