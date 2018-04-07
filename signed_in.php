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
  if (isset($_POST['submit_friend_request'])) {
    
  }
  ?>
  <ul>
  </ul>
  <h4>Friends</h4>
  <ul>
  </ul>
  <h4>Send Friend Request</h4>
  <form action="index.php" method="post">
    <label>E-mail</label> <input type="text" name="email"> <br>
    <input type="submit" name="submit_friend_request" value="Login">
  </form>
</div>
