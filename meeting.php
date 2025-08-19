<?php
session_start();
if (!isset($_SESSION['studentid'])) {
	header("Location: login.php");
	exit();
}

require_once '../db_connection.php';

// Example studentid (replace with actual logic to get studentid dynamically)
$studentid = $_SESSION['studentid'];

// Fetch student information (full name and student ID)
$sql_student = "SELECT fullname, studentid FROM student WHERE studentid = '$studentid'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
	$student = $result_student->fetch_assoc();
	$fullname = $student['fullname'];
	$studentid_display = $student['studentid'];
} else {
	// Handle case where student information is not found
	$fullname = "Student Name"; // Default value if not found
	$studentid_display = "@studentid"; // Default value if not found
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UniKL Hub - My Timetable</title>

	<link rel="stylesheet" href="css/font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/meeting.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<div id="wrapper" class="container">

		<?php include 'includes/header.html'; ?>

		<div id="profile">
			<div class="wrapper20">
				<div class="userInfo">
					<div class="userImg">
						<img src="images/user/<?php echo htmlspecialchars($studentid); ?>.jpg" rel="user">
					</div>
					<div class="userTxt">
						<span class="fullname"><?php echo htmlspecialchars($fullname); ?></span>
						<i class="fa fa-chevron-right"></i><br>
						<span class="username"><?php echo htmlspecialchars($studentid); ?></span>
					</div>
				</div>
				<!-- /userInfo -->

				<i class="fa fa-bars icon-nav-mobile"></i>
			</div>
		</div>
		<!-- /profile -->

		<div id="sidebar">
			<ul class="mainNav">
				<li>
					<a href="dashboard.php">
						<i class="fa fa-home"></i><br>Dashboard</a>
				</li>
				<li>
					<a href="profile.php">
						<i class="fa fa-user"></i><br>My Profile</a>
				</li>
				<li>
					<a href="mycourse.php">
						<i class="fa fa-book"></i><br>My Course</a>
				</li>
				<li class="active">
					<a href="#">
						<i class="fa fa-calendar"></i><br>Timetable</a>

				</li>
				<li>
					<a href="ghocs.php">
						<i class="fa fa-trophy"></i><br>GHOCs</a>
				</li>
			</ul>
		</div>
		<!-- /sidebar -->

		<div id="main" class="clearfix">

			<div class="secInfo">
				<h1 class="secTitle">Your Timetable</h1>
				<span class="secExtra">Subject &amp; class schedule</span>
			</div>
			<!-- /SecInfo -->

			<div class="fluid">

				<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
					rel="stylesheet">
				<div class="idance">
					<div class="schedule content-block">
						<div class="container">
							<h2 data-aos="zoom-in-up" class="aos-init aos-animate">Schedule</h2>
							<div class="timetable">

								<nav class="nav nav-tabs">
									<a class="nav-link active">Mon</a>
									<a class="nav-link">Tue</a>
									<a class="nav-link">Wed</a>
									<a class="nav-link">Thu</a>
									<a class="nav-link">Fri</a>
									<a class="nav-link">Sat</a>
									<a class="nav-link">Sun</a>
								</nav>
								<div class="tab-content">
									<div class="tab-pane show active">
										<div class="row">

											<div class="col-md-6">
												<div class="timetable-item">
													<div class="timetable-item-img">
														<img src="https://www.bootdey.com/image/100x80/FFB6C1/000000"
															alt="Contemporary Dance">
													</div>
													<div class="timetable-item-main">
														<div class="timetable-item-time">8:00am - 10:00am</div>
														<div class="timetable-item-name">Mobile Development</div>
														<a href="#" id="onlineMeetButton1"
															class="btn btn-primary btn-book">Online Meet</a>
														<div class="timetable-item-like">
															<i class="fa fa-heart-o" aria-hidden="true"></i>
															<i class="fa fa-heart" aria-hidden="true"></i>
															<div class="timetable-item-like-count">11</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="timetable-item">
													<div class="timetable-item-img">
														<img src="https://www.bootdey.com/image/100x80/00FFFF/000000"
															alt="Break Dance">
													</div>
													<div class="timetable-item-main">
														<div class="timetable-item-time">12:00pm - 2:00pm</div>
														<div class="timetable-item-name">Software Design and Integration
														</div>
														<div class="timetable-item-room" style="font-size: 18px;">Room
															2107</div>
														<div class="timetable-item-like">
															<i class="fa fa-heart-o" aria-hidden="true"></i>
															<i class="fa fa-heart" aria-hidden="true"></i>
															<div class="timetable-item-like-count">28</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="timetable-item">
													<div class="timetable-item-img">
														<img src="https://www.bootdey.com/image/100x80/8A2BE2/000000"
															alt="Street Dance">
													</div>
													<div class="timetable-item-main">
														<div class="timetable-item-time">3:00pm - 4:00pm</div>
														<div class="timetable-item-name">Web Application Development
														</div>
														<div class="timetable-item-room" style="font-size: 18px;">Room
															2105</div>
														<div class="timetable-item-like">
															<i class="fa fa-heart-o" aria-hidden="true"></i>
															<i class="fa fa-heart" aria-hidden="true"></i>
															<div class="timetable-item-like-count">28</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="timetable-item">
													<div class="timetable-item-img">
														<img src="https://www.bootdey.com/image/100x80/6495ED/000000"
															alt="Yoga">
													</div>
													<div class="timetable-item-main">
														<div class="timetable-item-time">4:30pm - 5:30pm</div>
														<div class="timetable-item-name">Advanced Programming</div>
														<div class="popup"></div>
														<a href="#" id="onlineMeetButton2"
															class="btn btn-primary btn-book">Online Meet</a>

														<div class="timetable-item-like">
															<i class="fa fa-heart-o" aria-hidden="true"></i>
															<i class="fa fa-heart" aria-hidden="true"></i>
															<div class="timetable-item-like-count">23</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="timetable-item">
													<div class="timetable-item-img">
														<img src="https://www.bootdey.com/image/100x80/00FFFF/000000"
															alt="Stretching">
													</div>
													<div class="timetable-item-main">
														<div class="timetable-item-time">6:00pm - 7:00pm</div>
														<div class="timetable-item-name">Innovation Management</div>
														<a href="#" id="onlineMeetButton"
															class="btn btn-primary btn-book">Online Meet</a>
														<div class="timetable-item-like">
															<i class="fa fa-heart-o" aria-hidden="true"></i>
															<i class="fa fa-heart" aria-hidden="true"></i>
															<div class="timetable-item-like-count">14</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="timetable-item">
													<div class="timetable-item-img">
														<img src="https://www.bootdey.com/image/100x80/008B8B/000000"
															alt="Street Dance">
													</div>
													<div class="timetable-item-main">
														<div class="timetable-item-time">8:00pm - 9:00pm</div>
														<div class="timetable-item-name">Selected Topics in Software
															Engineering</div>
														<div class="timetable-item-room" style="font-size: 18px;">Room
															1905</div>
														<div class="timetable-item-like">
															<i class="fa fa-heart-o" aria-hidden="true"></i>
															<i class="fa fa-heart" aria-hidden="true"></i>
															<div class="timetable-item-like-count">9</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /fluid -->

			</div>
			<!-- /main -->

		</div>
		<!-- /wrapper -->

		<div class="clearfix"></div>
		<?php include 'includes/footer.html'; ?>

		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script>
			// JavaScript Code
			document.getElementById('onlineMeetButton').addEventListener('click', function (event) {
				event.preventDefault(); // Prevent the default anchor action
				var userInput = window.prompt("Would you like to join the Teams online meeting? Enter 'yes' to join.");
				if (userInput.toLowerCase() === 'yes') {
					// Logic to join the Teams meeting
					console.log("Joining the Teams meeting...");
					// You can redirect the user to the meeting URL or perform other actions here
				}
			});
		</script>
		<script>
			// JavaScript Code
			document.getElementById('onlineMeetButton2').addEventListener('click', function (event) {
				event.preventDefault(); // Prevent the default anchor action
				var userInput = window.prompt("Would you like to join the Teams online meeting? Enter 'yes' to join.");
				if (userInput.toLowerCase() === 'yes') {
					// Logic to join the Teams meeting
					console.log("Joining the Teams meeting...");
					// You can redirect the user to the meeting URL or perform other actions here
				}
			});
		</script>
		<script>
			// JavaScript Code
			document.getElementById('onlineMeetButton1').addEventListener('click', function (event) {
				event.preventDefault(); // Prevent the default anchor action
				var userInput = window.prompt("Would you like to join the Teams online meeting? Enter 'yes' to join.");
				if (userInput.toLowerCase() === 'yes') {
					// Logic to join the Teams meeting
					console.log("Joining the Teams meeting...");
					// You can redirect the user to the meeting URL or perform other actions here
				}
			});
		</script>
</body>

</html>