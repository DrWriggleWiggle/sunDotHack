<?php
  $dbc = mysqli_connect("localhost", "root", "sunhacks", "socialcalendar") or die("<h1>Error Connecting to Database</h1>");

  function query($q_string) {
    global $dbc;
    $result = mysqli_query($dbc, $q_string) or die ("<h1>Error with following query:</h1>\n<h2>$q_string</h2>");
    return $result;
  }

  function getLastRow($table, $id_name) {
    $q = "SELECT * FROM $table ORDER BY $id_name DESC LIMIT 1";
    $result = query($q);
    $row = mysqli_fetch_assoc($result);
    return $row;
  }
/*
  function getInvites($id) {
    $invitations = getTable("actions WHERE member='" . $id . "' AND accepted='0';");
    $data = array();
    foreach ($invitations as $i) {
      $event = getEventById($i['event']);
      array_push($data, $event);
    }
    return $data;
  }*/

  function getFriends($id) {
    $friends = getTable("friends WHERE (friend2='" . $id . "' OR friend1='" . $id . "') AND accepted='1';");
    $data = array();
    foreach ($friends as $f) {
      $member = getMemberById($f['friend1']);
      if ($member['memberId'] == $id) {
        $member = getMemberById($f['friend2']);
      }
      array_push($data, $member);
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
/*
  function getEventById($val){
    $request = query("SELECT * FROM events WHERE eventId='$val'");
    if ($row = mysqli_fetch_assoc($request)) {
      return $row;
    }
  }*/
?>
