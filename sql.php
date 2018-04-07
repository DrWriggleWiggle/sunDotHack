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

  function addFriendConnection($friend1, $friend2) {
    query(
      "INSERT INTO friends (friend1, friend2, accepted)
      VALUES ('$friend1', '$friend2', '0');
      "
    );
  }

  function getFriendRequests($id) {
    $q = "SELECT * FROM friends WHERE friend2='$id' AND accepted='0';";
    $result = query($q);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($data, $row);
    }
    return $data;
  }

  function getFriends($id) {
    $q = "SELECT * FROM friends WHERE (friend1='$id' OR friend2='$id') AND accepted='1';";
    $result = query($q);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($data, $row);
    }
    return $data;
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
