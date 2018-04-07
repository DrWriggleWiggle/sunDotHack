<?php
  $dbc = mysqli_connect("localhost", "root", "", "socialcalendar") or die("<h1>Error Connecting to Database</h1>");

  function query($q_string) {
    global $dbc;
    $result = mysqli_query($dbc, $q_string) or die ("<h1>Error with following query:</h1>\n<h2>$q_string</h2>");
    return $result;
  }

  function createAccount($first_name, $last_name, $email, $password) {
    query(
      "INSERT INTO members (firstName, lastName, email, password)
      VALUES ('$first_name', '$last_name', '$email', SHA('$password'));
      "
    );
  }

  function getTable($table) {
    $q = "SELECT * FROM $table";
    $result = query($q);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($data, $row);
    }
    return $data;
  }

  function getMemberById($val) {
    $request = query("SELECT * FROM members WHERE memberId='$val'");
    if ($row = mysqli_fetch_assoc($request)) {
      return $row;
    }
  }
?>
