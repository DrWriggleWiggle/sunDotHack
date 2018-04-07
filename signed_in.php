<?php
$name = $_SESSION['user'];
echo "<h2>Logged in as $name.</h2>";
?>
<?php
if (isset($_POST["submit_friend_request"])) {
  $email = $_POST['email'];
  echo "<h3>Friend Request Sent to $email<h3>";
}
?>
<form action="index.php" method="post">
  <div>
    <input type="submit" name="submit_logout" value="Logout">
  </div>
</form>
<h3>Friends</h3>
<h4>WIP</h4>
<h3>Send Friend Request</h3>
<form action="index.php" method="post">
  <div>
    <label>E-mail</label> <input type="text" name="email"> <br>
    <input type="submit" name="submit_friend_request" value="Logout">
  </div>
</form>
