<div class="shadow"></div>
<div class="hideSkipLink">
</div>
<div class="main">
    <div style="float:left; width: 160px;">
        <div id="nav"></div>
    </div>
    <div style="margin-left: 160px;">
        <div id="dp"></div>
    </div>

    <!-- Modal for event editing -->
    <div id="eventModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Event Editor</h2>
        <form id="editForm" action="index.php" method="post">
          <input type="hidden" name="eventId" id="eid">
          Event Name: <input type="text" name="event_name" id="event_name"><br>
          Starts at: <input type="date" name="start_date" id="start_date"> <input type="time" name="start_time" id="start_time"><br>
          Ends at: <input type="date" name="end_date" id="end_date"> <input type="time" name="end_time" id="end_time"><br>
          Location: <input type="text" name="location" id="location"> <br>
          Invitations:<br>
          <?php $friends = getFriends($_SESSION['id']); ?>
          <select name="invite_list[]" size=<?php $num = count($friends); if ($num > 10) {$num = 10;} echo $num; ?> multiple>
            <?php
            foreach ($friends as $friend) {
              echo "<option value='" . $friend['memberId'] . "'>" . $friend['firstName'] . ' ' . $friend['lastName'] . "</option>";
            }
            ?>
          </select>
          <input type="submit" name="submit_edit_event" value="Update Event" action="./signed_in.php">
          <input type="submit" name="submit_delete_event" value="Delete Event" action="./signed_in.php">
        </form>
      </div>
    </div>

    <script type="text/javascript">

        var nav = new DayPilot.Navigator("nav");
        nav.showMonths = 3;
        nav.skipMonths = 3;
        nav.selectMode = "week";
        nav.onTimeRangeSelected = function(args) {
            dp.startDate = args.day;
            dp.update();
            loadEvents();
        };
        nav.init();

        var dp = new DayPilot.Calendar("dp");
        dp.viewType = "Week";

        /*
        dp.onEventMoved = function (args) {
            $.post("backend_move.php",
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString()
                    },
                    function() {
                        console.log("Moved.");
                    });
        };

        dp.onEventResized = function (args) {
            $.post("backend_resize.php",
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString()
                    },
                    function() {
                        console.log("Resized.");
                    });
        };

        // event creating
        dp.onTimeRangeSelected = function (args) {
            var name = prompt("New event name:", "Event");
            dp.clearSelection();
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                id: DayPilot.guid(),
                resource: args.resource,
                text: name
            });
            dp.events.add(e);

            $.post("backend_create.php",
                    {
                        start: args.start.toString(),
                        end: args.end.toString(),
                        name: name
                    },
                    function() {
                        console.log("Created.");
                    });

        };
        */

        dp.init();

        loadEvents();

        function loadEvents() {
          dp.events.list = [
            <?php
              function event_json_encode($event) {
                $start = $event['startDate'];
                $start = str_replace(" ", "T", $start);
                $end = $event['endDate'];
                $end = str_replace(" ", "T", $end);
                $id = $event['eventId'];
                $text = $event['name'] . '|location: ' . $event['location'];

                $code = "{";
                $code .= "start: \"$start\", ";
                $code .= "end: \"$end\", ";
                $code .= "id: \"$id\", ";
                $code .= "text: \"$text\"";
                $code .= "}";
                return $code;
              }

              function action_json_encode($action) {
                $event = getTable("events WHERE eventId='" . $action['event'] . "'");
                return event_json_encode($event[0]);
              }

              require_once("sql.php");
              $owned_events = getTable("events WHERE owner='" . $_SESSION['id'] . "'");
              $json_event_list = array();
              foreach ($owned_events as $event) {
                array_push($json_event_list, event_json_encode($event));
              }

              $invited_events = getTable("actions WHERE member='" . $_SESSION['id'] . "' AND accepted='1'");
              foreach ($invited_events as $action) {
                array_push($json_event_list, action_json_encode($action));
              }

              echo implode(",", $json_event_list);
            ?>
          ];
          dp.update();
            /*var start = dp.visibleStart();
            var end = dp.visibleEnd();

            //TODO replace with our own PHP code to grab event list

            //Test
            dp.events.list = [
              {
                start: "2018-04-07T20:00:00",
                end: "2018-04-08T08:00:00",
                id: "1",
                text: "Dr. Wriggle Wiggle's wiggle party"
              }
            ];

            dp.update();

            /*
            $.post("backend_events.php",
            {
                start: start.toString(),
                end: end.toString()
            },
            function(data) {
                //console.log(data);
                dp.events.list = data;
                dp.update();
            });
            */
        }

    </script>

    <script>
      var eModal = document.getElementById("eventModal");
      var closeBtn = document.getElementsByClassName("close");

      //Event edit handler
      dp.onEventClick = function(args) {
        eModal.style.display = "block";

        document.getElementById("eid").value = args.e.id();

        //TODO parse the fields correctly
        document.getElementById("event_name").value = args.e.text();
        document.getElementById("start_date").value = args.e.start();
        document.getElementById("start_time").value = args.e.start();
        document.getElementById("end_date").value = args.e.end();
        document.getElementById("end_time").value = args.e.end();
        document.getElementById("location").value = args.e.text();
        //alert("clicked: " + args.e.id());
      };

      for (var i = 0; i < closeBtn.length; ++i) {
        closeBtn[i].onclick = function(){
          eModal.style.display = "none";
        }
      }

      window.onclick = function(event){
        if(event.target == eModal){
          eModal.style.display = "none";
        }
      }
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#theme").change(function(e) {
            dp.theme = this.value;
            dp.update();
        });
    });
    </script>

</div>
<div class="clear">
</div>
