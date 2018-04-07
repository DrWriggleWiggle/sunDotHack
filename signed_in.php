<?php
$name = $_SESSION['user'];
echo "<h2>Logged in as $name.</h2>";
?>
<form action="index.php" method="post">
  <div>
    <input type="submit" name="submit_logout" value="Logout">
  </div>
</form>
<div>
  <h3>Friends</h3>
  <h4>Requests</h4>
  <?php
  require_once("sql.php");
  if (isset($_POST['submit_friend_request'])) {
    $friend1 = $_SESSION['id'];
    $friend2 = -1;
    $result = getTable("members WHERE email='" . $_POST['email'] . "'");
    if (count($result) == 0) {
      echo "<h5><em>Cannot find user with email " . $_POST['email'] . "</em></h5>";
    } else {
      $member = $result[0];
      $friend2 = $member['memberId'];
      if ($member['memberId'] == $_SESSION['id']) {
        echo "<h5><em>Cannot send a friend request to yourself</em></h5>";
      } else {
        $test = getTable("friends WHERE (friend1='" . $_SESSION['id'] . "' AND friend2='$friend2') OR (friend2='" . $_SESSION['id'] . "' AND friend1='$friend2');");
        if (count($test) > 0) {
          echo "<h5><em>Friendship already going on.</em></h5>";
        } else {
          query(
            "INSERT INTO friends (friend1, friend2, accepted)
            VALUES ('$friend1', '$friend2', '0');"
          );
          echo "<h5><em>Friendship requested from " . $member['firstName'] . ' ' . $member['lastName'] . "</em></h5>";
        }
      }
    }
  }

  if (isset($_POST['submit_friend_request_accept'])) {
    query(
      "UPDATE friends SET accepted='1'
      WHERE friend1='" . $_POST['friend1'] . "' AND friend2='" . $_SESSION['id'] . "';
      "
    );
  } else if (isset($_POST['submit_friend_request_reject'])) {
    query(
      "DELETE FROM friends
      WHERE friend1='" . $_POST['friend1'] . "' AND friend2='" . $_SESSION['id'] . "';
      "
    );
  }

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
    if (isset($_POST['submit_friend_request_remove'])) {
      query("DELETE FROM friends WHERE (friend1='" . $_POST['friend'] . "' AND friend2='" . $_SESSION['id'] . "') OR (friend2='" . $_POST['friend'] . "' AND friend1='" . $_SESSION['id'] . "')");
      echo "<h5><em>Friendship with " . $_POST['friend'] . " has been removed.</em></h5>";
    }

    $friends = getTable("friends WHERE (friend2='" . $_SESSION['id'] . "' OR friend1='" . $_SESSION['id'] . "') AND accepted='1';");
    foreach ($friends as $f) {
      $member = getMemberById($f['friend1']);
      if ($member['memberId'] == $_SESSION['id']) {
        $member = getMemberById($f['friend2']);
      }
      echo "<li>";
      echo "You are friends with " . $member['firstName'] . ' ' . $member['lastName'];
      echo "<form action='index.php' method='post'>";
      echo "<div>";
      echo "<input type='hidden' value='" . $member['memberId'] . "' name='friend'>";
      echo "<input type='submit' value='Remove' name='submit_friend_request_remove'>";
      echo "</div>";
      echo "</form>";
      echo "</li>";
    }
    ?>
  </ul>
  <h4>Send Friend Request</h4>
  <form action="index.php" method="post">
    <label>E-mail</label> <input type="text" name="email"> <br>
    <input type="submit" name="submit_friend_request" value="Request Friendship">
  </form>
</div>
