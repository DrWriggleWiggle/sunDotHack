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

  function getLastRow($table) {
    $q = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
    $result = query($q);
    $row = mysqli_fetch_assoc($result);
    return $row;
  }

  function getFirstRow($table) {
    $q = "SELECT * FROM $table ORDER BY id LIMIT 1";
    $result = query($q);
    $row = mysqli_fetch_assoc($result);
    return $row;
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

  function getById($table, $val) {
    $request = query("SELECT * FROM $table WHERE id='$val'");
    if ($row = mysqli_fetch_assoc($request)) {
      return $row;
    }
  }
?>
