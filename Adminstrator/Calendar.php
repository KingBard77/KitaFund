<!--========== CALENDAR ==========-->
<?php
// Set the page title and include the HTML header:
$page_title = 'Calendar';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

// Define the query:
$query = "SELECT * FROM event ORDER BY id ASC";
$event = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$event_num = mysqli_num_rows($event);

?>

<!-- Plugin css for this page -->
<link rel="stylesheet" href="../Calendar/fullcalendar/fullcalendar.min.css" />
<script src="../Calendar/fullcalendar/lib/jquery.min.js"></script>
<script src="../Calendar/fullcalendar/lib/moment.min.js"></script>
<script src="../Calendar/fullcalendar/fullcalendar.min.js"></script>

<link rel="stylesheet" href="../vendors/fullcalendar/fullcalendar.min.css">
<!-- End plugin css for this page -->

<script>
$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "../Calendar/fetch-event.php",
        displayEventTime: false,
        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: '../Calendar/add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function(data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true
                );
            }
            calendar.fullCalendar('unselect');
        },

        editable: true,
        eventDrop: function(event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            $.ajax({
                url: '../Calendar/edit-event.php',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end +
                    '&id=' + event.id,
                type: "POST",
                success: function(response) {
                    displayMessage("Updated Successfully");
                }
            });
        },
        eventClick: function(event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "../Calendar/delete-event.php",
                    data: "&id=" + event.id,
                    success: function(response) {
                        if (parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
    $(".response").html("<div class='success'>" + message + "</div>");
    setInterval(function() {
        $(".success").fadeOut();
    }, 1000);
}
</script>

<style>
body {
    text-align: center;
    font-size: 12px;
}

#calendar {
    width: 1240px;
    margin: 0 auto;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
</style>


<div class='main-panel'>
    <div class='content-wrapper'>
        <div class="row">
            <div class="col-md-2">
                <div class="fc-external-events">
                <?php
                    // Define the query:
                    $query = "SELECT * FROM event
                    ORDER BY id ASC";
                    $event = mysqli_query($dbc, $query);

                    // Count the number of returned rows:
                    $event_num = mysqli_num_rows($event);
                    if(mysqli_num_rows($event) > 0)  
                    {  
                        while($row = mysqli_fetch_array($event))  
                        {  
                    ?>
                    <div class='fc-event'>
                        <p align="left"><b>Event:</b> <?php echo $row["title"]; ?></p>

                        <?php $start_event = strtotime ($row['start']);?>
                        <p align="left" class="small-text"><b>Start: </b><?php echo date('d M, Y', $start_event)?></p>

                        <?php $end_event = strtotime ($row['end']);?>
                        <p align="left" class="small-text"><b>End: </b><?php echo date('d M, Y', $end_event)?></p>
                        
                        <p align="left"class="text-muted mb-0">* All BurgerByte Staff</p>
                    </div>
                    <?php  
                        }  
                    }  
                    ?>
                </div>
                <div class="mt-4">
                    <p align="left">Filter board</p>
                    <div class="form-check form-check-primary">
                        <label align ="left" class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked>
                            Daily Project Board
                        </label>
                    </div>
                    <div class="form-check form-check-danger">
                        <label align ="left" class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked>
                            Long Project Board
                        </label>
                    </div>
                    <div class="form-check form-check-info">
                        <label align ="left" class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked>
                            Summary Board
                        </label>
                    </div>
                    <div class="form-check form-check-success">
                        <label align ="left" class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked>
                            Important Planner Board
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-10 grid-margin stretch-card">
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title' align="center">Calendar</h4>
                        <p class="card-description" align="center">
                            There are currently <b><?php echo "$event_num" ?> Events </b>
                            Registration</p>

                        <div class="response"></div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>

        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>