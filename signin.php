<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="login-style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>

	</style>
</head>

<body>
	<?php
	include_once("./connect.php");
	session_start();
	if (isset($_POST['register'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$facultyId = $_POST['faculty'];
		$confirmPassword = $_POST['confirm_password'];
		$email = $_POST['email'];

		// Check if the username already exists
		$check_username_query = "SELECT * FROM users WHERE username = '$username'";
		$check_username_result = $conn->query($check_username_query);

		// Array to store error messages
		$errors = array();

		// Check if all fields are filled
		if (empty($username) || empty($password) || empty($name) || empty($facultyId) || empty($confirmPassword) || empty($email)) {
			$errors[] = "Please fill in all fields.";
		} else if ($check_username_result->num_rows > 0) {
			$errors[] = "Username already exists. Please choose another username.";
		} else if ($password !== $confirmPassword) {
			$errors[] = "Passwords do not match. Please try again.";
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email address. Please enter a valid email.";
		}

		// If there are errors, display an alert box and redirect back to the registration page
		if (!empty($errors)) {
			echo '<script>';
			echo 'Swal.fire({';
			echo '    title: "Errors",';
			echo '    text: "' . implode("\\n", $errors) . '",';
			echo '    icon: "error"';
			echo '}).then(function() {';
			echo '    window.history.go(-1);'; // Redirect back to the previous page after the user clicks OK
			echo '});';
			echo '</script>';
		} else {
			// Add the account to the database if there are no errors
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$insert_query = "INSERT INTO users (username, password, name, facultyId, email, roleId, status) VALUES ('$username', '$hashed_password','$name','$facultyId', '$email', 2, 0)";

			if ($conn->query($insert_query) === TRUE) {
				echo '<script>';
				echo 'Swal.fire({';
				echo '    title: "Register successfully",';
				echo '    text: "Your registration has been successfully!",';
				echo '    icon: "success"';
				echo '}).then(function() {';
				echo '    window.history.go(-1);'; // Redirect back to the previous page after the user clicks OK
				echo '});';
				echo '</script>';
			} else {
				echo '<script>';
				echo 'Swal.fire({';
				echo '    title: "Error!",';
				echo '    text: "ERROR ' . $conn->error . '",';
				echo '    icon: "error"';
				echo '});';
				echo '</script>';
			}
		}
	}



	if (isset($_POST['signin'])) {
		// Check if username and password are provided
		if (empty($_POST['username']) || empty($_POST['password'])) {
			echo '<script>';
			echo 'Swal.fire({';
			echo '    title: "Empty fields",';
			echo '    text: "Username and password cannot be empty.",';
			echo '    icon: "error"';
			echo '}).then(function() {';
			echo '    window.history.back();'; // Redirect back to the previous page after the user clicks OK
			echo '});';
			echo '</script>';
			exit();
		}

		// Get input data and prevent SQL injection
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		// Search for the user by username
		$result = mysqli_query($conn, "SELECT userId, username, password, roleId, status FROM users WHERE username='$username'");

		// Check if the user exists
		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			$hashed_password = $row['password'];
			$status = $row['status'];

			// Check if the account is approved
			if ($status == 0) {
				echo '<script>';
				echo 'Swal.fire({';
				echo '    title: "Account not approved",';
				echo '    text: "Please contact the administrator.",';
				echo '    icon: "warning"';
				echo '}).then(function() {';
				echo '    window.history.back();'; // Redirect back to the previous page after the user clicks OK
				echo '});';
				echo '</script>';

				exit();
			}

			// Compare the input password with the hashed password from the database
			if (password_verify($password, $hashed_password)) {
				// Successful login, set session and redirect user
				$userRole = $row["roleId"];
				$userId = $row["userId"];
				$_SESSION['userid'] = $userId;

				if ($userRole == "2") {
					$_SESSION['username'] = $username;

					echo "<script>";
					echo "Swal.fire({";
					echo "    position: 'center',";
					echo "    icon: 'success',";
					echo "    title: 'Login successful!',";
					echo "    showConfirmButton: false,";
					echo "    timer: 1500";
					echo "}).then(function() {"; // Thực hiện sau khi thông báo biến mất
					echo "        window.location.href = './index.php';"; // Chuyển hướng
					echo "});";
					echo "</script>";
				} else {
					$_SESSION['username'] = $username;
					echo '<script>';
					echo 'Swal.fire({';
					echo '    title: "Redirecting...",';
					echo '    text: "You will be redirected to the admin page shortly.",';
					echo '    icon: "info",';
					echo '    showConfirmButton: false';
					echo '});';
					echo 'setTimeout(function() {';
					echo '    window.location.href = "./Adminitrator/UI/html/index.php";'; // Redirect to the admin page after a delay
					echo '}, 5000);'; // Delay in milliseconds, e.g., 2000ms = 2 seconds
					echo '</script>';
				}
			} else {
				// Incorrect password
				echo "<script>";
				echo "Swal.fire({";
				echo "    title: 'Incorrect password',";
				echo "    text: 'Please try again.',";
				echo "    icon: 'error'";
				echo "}).then(function() {";
				echo "    window.history.back();"; // Redirect back to the previous page after the user clicks OK
				echo "});";
				echo "</script>";

				exit();
			}
		} else {
			// User does not exist
			echo '<script>';
			echo 'Swal.fire({';
			echo '    title: "Username not found",';
			echo '    text: "Please check again.",';
			echo '    icon: "error"';
			echo '}).then(function() {';
			echo '    window.history.back();'; // Redirect back to the previous page after the user clicks OK
			echo '});';
			echo '</script>';

			exit();
		}
	}


	?>
	<div id="container" class="container">
		<!-- FORM SECTION -->
		<section class="forms-section">
			<h1 class="section-title">Login & Signup Forms</h1>
			<div class="forms">
				<div class="form-wrapper is-active">
					<button type="button" class="switcher switcher-login">
						Login
						<span class="underline"></span>
					</button>
					<form action="#" class="form form-login" method="post">
						<fieldset>
							<legend>Please, enter your email and password for login.</legend>
							<input type="hidden" name="signin" value="1">
							<div class="input-block">
								<label for="username">E-mail</label>
								<input id="username" name="username" type="username" required>
							</div>
							<div class="input-block">
								<label for="password">Password</label>
								<input id="password" name="password" type="password" required>
							</div>
						</fieldset>
						<button type="submit" class="btn-login">Login</button>
					</form>
				</div>
				<div class="form-wrapper">
					<button type="button" class="switcher switcher-signup">
						Sign Up
						<span class="underline"></span>
					</button>
					<form class="form form-signup" action="#" method="post">
						<fieldset>
							<input type="hidden" name="register" value="1">
							<legend>Please, enter your email, password and password confirmation for sign up.</legend>
							<div class="input-block">
								<label for="name">Name</label>
								<input id="signup-name" name="name" type="text" required>
							</div>
							<div class="input-block">
								<label for="username">UserName</label>
								<input id="signup-username" name="username" type="username" required>

								<div class="input-block">
									<label for="signup-email">E-mail</label>
									<input id="signup-email" name="email" type="email" required>
								</div>
								<div class="input-block">
									<label for="password">Password</label>
									<input id="signup-password" name="password" type="password" required>
								</div>
								<div class="input-block">
									<label for="signup-password">Confirm Password</label>
									<input id="signup-password" name="confirm_password" type="password" required>
								</div>
								<div class="input-block">
									<label for="signup-password">Faculty</label>
									<select id="facultyInput" name="faculty">
										<option value="" selected disabled>Select faculty/department</option>
										<?php
										// Query the database to retrieve the list of faculties/departments
										$queryFaculties = "SELECT facultyId, facultyName FROM faculties";
										$resultFaculties = mysqli_query($conn, $queryFaculties);

										// Check if any records are returned
										if (mysqli_num_rows($resultFaculties) > 0) {
											// Iterate through each record and create options for the select field
											while ($rowFaculties = mysqli_fetch_assoc($resultFaculties)) {
												echo "<option value='" . $rowFaculties['facultyId'] . "'>" . $rowFaculties['facultyName'] . "</option>";
											}
										} else {
											echo "<option value=''>No data available</option>";
										}

										// Close the database connection
										mysqli_close($conn);
										?>
									</select>
						</fieldset>
						<button type="submit" class="btn-signup">Sign Up</button>
					</form>
				</div>
			</div>
		</section>
		<!-- END CONTENT SECTION -->
	</div>

	<script src="login-animation.js"></script>
	<script>
		function showSuccessAlert() {
			Swal.fire({
				title: "Good job!",
				text: "Login successful!",
				icon: "success"
			}).then(function() {
				window.location.href = "./index.php"; // Redirect after the user clicks the button in the alert
			});
		}
	</script>
</body>

</html>