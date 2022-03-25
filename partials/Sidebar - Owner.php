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
            <a class="nav-link" data-toggle="collapse" href="#salesprofit" aria-expanded="false" aria-controls="salesprofit">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Sales & Profit</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="salesprofit">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Stock_Calculation.php">Stock Calculation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="Invoice_Calculation.php">Invoice Calculation</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="Income_Calculation.php">Income</a></li>
                </ul>
            </div>
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
            <a class="nav-link" data-toggle="collapse" href="#employee" aria-expanded="false" aria-controls="employee">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Employees</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="employee">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Employees.php">Manage Employee</a></li>
                    <li class="nav-item"> <a class="nav-link" href="Employees_Profile.php">Profile Employee</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#attendance" aria-expanded="false" aria-controls="attendance">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Attendance</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="attendance">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Attendance.php">Manage Attendance</a>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#commission" aria-expanded="false" aria-controls="commission">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Commission</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="commission">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Commission.php">Manage Commmission</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#leave" aria-expanded="false" aria-controls="leave">
                <i class="icon-heart menu-icon"></i>
                <span class="menu-title">Medical Leaves</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="leave">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Leaves.php"> Manage Leaves </a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock">
                <i class="icon-tag menu-icon"></i>
                <span class="menu-title">Stock</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="stock">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Category.php"> Category </a></li>
                    <li class="nav-item"> <a class="nav-link" href="Stock.php"> Manage Stock </a></li>
                    <li class="nav-item"> <a class="nav-link" href="Stock_Purchase.php"> Purchase Stock </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="Purchase.php"> Manage Purchase </a>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#rawmaterials" aria-expanded="false" aria-controls="rawmaterials">
                <i class="icon-align-right menu-icon"></i>
                <span class="menu-title">Ordering</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="rawmaterials">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="Ordering.php"> Ordering </a>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="Supplier.php?id=1">
                <i class="icon-mail menu-icon"></i>
                <span class="menu-title">Reporting</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="Calendar.php">
                <i class="icon-watch menu-icon"></i>
                <span class="menu-title">Calendar</span>
            </a>
        </li>
    </ul>
</nav>

<!-- plugins:js -->
<script src="../vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->