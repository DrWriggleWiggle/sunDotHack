<?php
  $dbc = mysqli_connect("localhost", "root", "sunhacks", "socialcalendar") or die("<h1>Error Connecting to Database</h1>");

  function query($q_string) {
    global $dbc;
    $result = mysqli_query($dbc, $q_string) or die ("<h1>Error with following query:</h1>\n<h2>$q_string</h2>");
    return $result;
  }

  function getFriends($id) {
    $friends = getTable("friends WHERE (friend2='" . $id . "' OR friend1='" . $id . "') AND accepted='1';");
    $date = array();
    foreach ($friends as $f) {
      $member = getMemberById($f['friend1']);
      if ($member['memberId'] == $id) {
        array_push($data, getMemberById($f['friend2']));
      }
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
