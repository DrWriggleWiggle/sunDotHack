<?php
$name = $_SESSION['user'];
echo "<h2>Logged in as $name.</h2>";
?>
<?php
require_once("sql.php");

if (isset($_POST["submit_friend_request"])) {
  $email = $_POST['email'];
  $name = 0;
  $id = -1;
  $members = getTable("members");
  foreach ($members as $m) {
    if ($m['email'] == $email) {
      $id = $m['memberId'];
      $name = $m['firstName'] . ' ' . $m['lastName'];
    }
  }
  if ($name === 0) {
    echo "<h3>$email does not have an account.</h3>";
  } else {
    if ($email == $_SESSION['email']) {
      echo "<h3>Cannot friend yourself.</h3>";
    } else {
      addFriendConnection($friend1, $id);
      $friend1 = $_SESSION['id'];
      echo "<h3>Friend Request Sent to $name.</h3>";
    }
  }
}
?>
<form action="index.php" method="post">
  <div>
    <input type="submit" name="submit_logout" value="Logout">
  </div>
</form>
<h3>Friends</h3>
<ul>
  <?php
  if (isset($_POST['submit_friend_request_accept'])) {
    query("UPDATE friends SET accepted='1' WHERE friend1='" . $_POST['friend1'] . "' AND friend2=" . $_SESSION['id'] . " AND accepted='0';");
  } else if (isset($_POST['submit_friend_request_reject'])) {
    query("DELETE FROM friends WHERE friend1='" . $_POST['friend1'] . "' AND friend2=" . $_SESSION['id'] . " AND accepted='0';");
  }

  $id = $_SESSION['id'];
  $requests = getFriendRequests($id);
  foreach ($requests as $r) {
    echo "<li>Friend Request from " . getMemberById($r['friend1'])["email"];
    echo "<form action='index.php' method='post'>";
    echo "<div>";
    echo "<input type='hidden' value='" . $r['friend1'] . "' name='friend1'>";
    echo "<input type='submit' value='Accept' name='submit_friend_request_accept'>";
    echo "<input type='submit' value='Reject' name='submit_friend_request_reject'>";
    echo "</div>";
    echo "</form></li>";
  }

  $friends = getFriends($id);
  foreach ($friends as $f) {
    $otherId = -1;
    if ($f['friend1'] == $id) {
      $otherId = $f['friend2'];
    } else {
      $otherId = $f['friend1'];
    }
    $value = getMemberById($otherId);
    $name = $value['firstName'] . ' ' . $value['lastName'];
    echo "<li>You have a friend named $name</li>";
  }
  ?>
</ul>
<h3>Send Friend Request</h3>
<form action="index.php" method="post">
  <div>
    <label>E-mail</label> <input type="text" name="email"> <br>
    <input type="submit" name="submit_friend_request" value="Request Friendship">
  </div>
</form>
