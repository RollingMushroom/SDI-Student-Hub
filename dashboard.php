<?php
session_start();
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

require_once '../db_connection.php';
require_once 'includes/Exception.php';

$studentid = $_SESSION['studentid'];

// Fetch student information
$sql_student = "SELECT fullname, studentid FROM student WHERE studentid = '$studentid'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    $student = $result_student->fetch_assoc();
    $fullname = $student['fullname'] ?? 'Student Name';
    $studentid_display = $student['studentid'] ?? '@studentid';
} else {
    // Handle case where student information is not found
    $fullname = "Student Name"; // Default value if not found
    $studentid_display = "@studentid"; // Default value if not found
}

// Initialize courses array
$courses = array();

try {
    // Fetch courses enrolled by the student, including progress
    $sql_courses = "SELECT c.course_code, c.course_name, sc.progress, c.id as course_id
                    FROM course c
                    JOIN student_course sc ON c.id = sc.course_id
                    WHERE sc.studentid = '$studentid'";

    $result_courses = $conn->query($sql_courses);

    if ($result_courses && $result_courses->num_rows > 0) {
        while ($row = $result_courses->fetch_assoc()) {
            $courses[] = $row;
        }
    } else {
        $_SESSION['error_messages'] = "You have not registered for any courses yet.";
    }
} catch (EnrolledCourseException $e) {
    $_SESSION['error_messages'] = "Failed to fetch courses: " . $e->getMessage();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKL Hub - Dashboard</title>
    <link rel="stylesheet" href="css/font-awesome-4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<?php include 'includes/header.html'; ?>

<div id="profile">
    <div class="wrapper20">
        <div class="userInfo">
            <div class="userImg">
                <img src="images/user/<?php echo htmlspecialchars($studentid ?? 'default'); ?>.jpg"
                    rel="user">
            </div>
            <div class="userTxt">
                <span class="fullname"><?php echo htmlspecialchars($fullname ?? 'Student Name'); ?></span>
                <i class="fa fa-chevron-right"></i><br>
                <span class="username"><?php echo htmlspecialchars($studentid_display ?? '@studentid'); ?></span>
            </div>
        </div>
        <!-- /userInfo -->
    </div>
</div>
<!-- /profile -->
</div>
<!-- /top -->

<?php include 'includes/sidebar.php'; ?>

<div id="main" class="clearfix">
    <div class="secInfo">
        <h1 class="secTitle">Dashboard</h1>
        <span class="secExtra">Course Overview</span>
    </div>
    <!-- /SecInfo -->

    <div class="fluid">
        <div class="widget leftcontent grid12">
            <div class="widget-content pad20f">
                <?php if (isset($_SESSION['error_messages'])): ?>
                    <div class="alert alert-danger">
                        <strong>Uh Oh!</strong> <?php echo htmlspecialchars($_SESSION['error_messages'] ?? ''); ?>
                    </div>

                <?php endif; ?>
                <?php foreach ($courses as $course): ?>
                    <div class="course-card">
                        <a href="viewsubject.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>">
                            <img class="course-img"
                                src="images/subject/<?php echo htmlspecialchars($course['course_code']); ?>.png"
                                alt="Course image">
                        </a>
                        <div class="course-body">
                            <a
                                href="viewsubject.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>">
                                <h5 class="course-title">
                                    <?php echo htmlspecialchars($course['course_code']) . ' - ' . htmlspecialchars($course['course_name']); ?>
                                </h5>
                            </a>
                            <p>
                            <div class="progress-container">
                                <div class="progress-bar"
                                    style="width: <?php echo htmlspecialchars($course['progress']); ?>%;"></div>
                            </div>
                            </p>
                            <p class="course-text"><?php echo htmlspecialchars($course['progress']); ?>% complete
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- /widget-content -->
        </div>
        <!-- /widget -->
    </div>
    <!-- /fluid -->
</div>
<!-- /main -->
</div>
<!-- /wrapper -->

<div class="clearfix"></div>
<?php include 'includes/footer.html'; ?>

<script type="text/javascript" src="js/prefixfree.min.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="js/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="js/excanvas.min.js"></script>
<script type="text/javascript" src="js/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>

</html>