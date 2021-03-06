<!DOCTYPE html>
<html>
<head>
  <?php require_once("head.php");?>
</head>
<html lang="en">
<body>
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
        dp.onEventClick = function(args) {
            alert("clicked: " + args.e.id());
        };

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
              $owned_events = getTable("events WHERE owner='" . $_POST['friend'] . "'");
              $json_event_list = array();
              foreach ($owned_events as $event) {
                array_push($json_event_list, event_json_encode($event));
              }

              $invited_events = getTable("actions WHERE member='" . $_POST['friend'] . "' AND accepted='1'");
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
<div>
  <a href='index.php'>Return</a>
</div>
</body>
</html>
