<!--========== SETTING PANEL=========-->
<?php
// Define the query:
$query = "SELECT * FROM event ORDER BY id ASC";
$event = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$event_num = mysqli_num_rows($event);

$query = "SELECT p.Profile_Id, e.Employee_Code, p.Image_Name, p.First_Name, p.Last_Name, 
p.Email, p.Phone, p.Joining_Date
FROM employee e, profile p
WHERE e.Profile_Id = p.Profile_Id
ORDER BY p.Profile_Id ASC";
$employee = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$employee_num = mysqli_num_rows($employee);
?>

<!-- partial:partials/_settings-panel.html -->
<div class="theme-setting-wrapper">
    <div id="settings-trigger"><i class="ti-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
        </div>
    </div>
</div>
<div id="right-sidebar" class="settings-panel">
    <i class="settings-close ti-close"></i>
    <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
                aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                aria-controls="chats-section">CHATS</a>
        </li>
    </ul>
    <div class="tab-content" id="setting-content">
        <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
            aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                        <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                    </div>
                </form>
            </div>
            <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Team review meeting at 3.00 PM
                            </label>
                        </div>
                        <i class="remove ti-close"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Prepare for presentation
                            </label>
                        </div>
                        <i class="remove ti-close"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Resolve all the low priority tickets due today
                            </label>
                        </div>
                        <i class="remove ti-close"></i>
                    </li>
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked>
                                Schedule meeting for next week
                            </label>
                        </div>
                        <i class="remove ti-close"></i>
                    </li>
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked>
                                Project review
                            </label>
                        </div>
                        <i class="remove ti-close"></i>
                    </li>
                </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">
                <b><?php echo "$event_num" ?> Events</b>
            </h4>
            <?php
                 if(mysqli_num_rows($event) > 0)  
                 {  
                     while($row = mysqli_fetch_array($event))  
                     {  
                         ?>
            <div class="events pt-4 px-3">
                <div class="form-check form-check-primary">
                    <label align="left" class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked>
                        <?php echo $row["title"]; ?>
                    </label>
                    <?php $start_event = strtotime ($row['start']);?>
                    <p class="text-gray mb-0">Start : <?php echo date('d M, Y', $start_event)?></p>

                    <?php $end_event = strtotime ($row['end']);?>
                    <p class="text-gray mb-0">End : <?php echo date('d M, Y', $end_event)?></p>
                </div>
            </div>
            <?php  
                        }  
                    }  
                    ?>
        </div>
        <!-- To do section tab ends -->
        <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                    All</small>
            </div>
            <ul class="chat-list">
                <?php
                ## Image Result
                $image = $row['Image_Name'];
                $image_src = "../Images/Employee_Image/".$image;

                while ($row = mysqli_fetch_array($employee, MYSQLI_ASSOC)) {
                echo '
                <li class="list active">
                    <div class="profile">
                        <img src="../Images/Employee_Image/'.$row["Image_Name"].'" alt="image"><span class="online"></span>
                    </div>
                    <div class="info">
                        <p>' . $row['First_Name'] .'</p>
                        <label class="badge badge-success">Active</label>
                    </div>
                    <small class="text-muted my-auto">19 min</small>
                </li>';}?>
            </ul>
        </div>
        <!-- chat tab ends -->
    </div>
</div>