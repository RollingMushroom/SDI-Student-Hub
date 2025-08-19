<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div id="sidebar">
    <ul class="mainNav">
        <li <?php echo ($current_page == 'dashboard.php') ? 'class="active"' : ''; ?>>
            <a href="dashboard.php">
                <i class="fa fa-home"></i><br>Dashboard</a>
        </li>
        <li <?php echo ($current_page == 'profile.php') ? 'class="active"' : ''; ?>>
            <a href="profile.php">
                <i class="fa fa-user"></i><br>My Profile</a>
        </li>
        <li <?php echo ($current_page == 'mycourse.php') ? 'class="active"' : ''; ?>>
            <a href="mycourse.php">
                <i class="fa fa-book"></i><br>My Course</a>
        </li>
        <li <?php echo ($current_page == 'meeting.php') ? 'class="active"' : ''; ?>>
            <a href="meeting.php">
                <i class="fa fa-calendar"></i><br>Timetable</a>
                <span class="badge badge-mNav">4</span>
        </li>
        <li <?php echo ($current_page == 'ghocs.php') ? 'class="active"' : ''; ?>>
            <a href="ghocs.php">
                <i class="fa fa-trophy"></i><br>GHOCS</a>
        </li>
    </ul>
</div>
<!-- /sidebar -->
