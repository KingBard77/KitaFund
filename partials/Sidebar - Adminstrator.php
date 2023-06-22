<!--========== OWNER SIDEBAR ==========-->

<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="DashBoard.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#profile" aria-expanded="false"
                aria-controls="profile">
                <i class="icon-book menu-icon"></i>
                <span class="menu-title">Account</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="profile">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="My_Profile.php">My Profile</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#donator" aria-expanded="false" aria-controls="donator">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Donator</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="donator">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Donators.php">Manage Donator</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#volunteer" aria-expanded="false" aria-controls="volunteer">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Volunteer</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="volunteer">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Volunteer.php">Manage Volunteer</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#contact" aria-expanded="false" aria-controls="contact">
                <i class="icon-align-right menu-icon"></i>
                <span class="menu-title">Contact</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="contact">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Contact.php">Manage Contact</a></li>
                </ul>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="Event.php">
                <i class="icon-watch menu-icon"></i>
                <span class="menu-title">Event</span>
            </a>
        </li>
    </ul>
</nav>

<!-- plugins:js -->
<script src="../vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->