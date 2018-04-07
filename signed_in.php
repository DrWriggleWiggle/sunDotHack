<?php
$name = $_SESSION['user'];
echo "<h2>Logged in as $name.</h2>";
?>
<form action="index.php" method="post">
  <div>
    <input type="submit" name="submit_logout" value="Logout">
  </div>
</form>
