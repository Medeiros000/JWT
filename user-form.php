<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
ob_start();
require_once 'helpers/h-functions.php';
require_once 'helpers/validate_token.php';
require_once 'helpers/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

	// Verify if user was in DB
	$query_user = "SELECT id, name, user, email, password 
						FROM users WHERE email = :email LIMIT 1";

	// Prepare query
	$stmt_user = $conn->prepare($query_user);

	// Bind parameters
	$stmt_user->bindParam(':email', $data['email']);

	// Execute query
	$stmt_user->execute();

	if (($stmt_user) && ($stmt_user->rowCount() > 0)) {
		$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
		$_SESSION['msg'] = h_alert('Email already registered.');

		// Generated link sent to email
		$_SESSION['email'] = $row_user['email'];
		// unset($data); 
		// Clear the variable for security reasons		
	}

	if (!empty($data['name']) && !empty($data['email']) && !empty($data['password'])) {
		$name = '';
		$email = '';
		$password = '';
		$password_ok = '';

		// Verify name
		if (preg_match('/[a-zA-Z0-9]{5,}/', $data['name'])) {
			$name = $data['name'];
		} else {
			$_SESSION['msg'] = h_alert('User entry incorrect...');
		}
		// Verify email
		if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$email = $data['email'];
		} else {
			$_SESSION['msg'] = h_alert('Email entry incorrect...');
		}
		// Verify password
		$p = $data['password'];
		if (preg_match('/[a-z]/', $p) && preg_match('/[A-Z]/', $p) && preg_match('/[0-9]/', $p) && preg_match('/[@.#$!%*?&^]/', $p) && strlen($data['password']) >= 8) {
			$password_ok = $data['password'];
		} else {
			$_SESSION['msg'] = h_alert('Password entry incorrect...');
		}

		$password = password_hash($password_ok, PASSWORD_DEFAULT);

		if (empty($_SESSION['msg'])) {
			// Verify if user was in DB
			$query_user = "INSERT INTO users (name, user, email, password) VALUES (?, ?, ?, ?)";
			$stmt_user = $conn->prepare($query_user);
			$stmt_user->execute([$name, $email, $email, $password]);

			$_SESSION['msg'] = h_alert('Registered successfully.', 'success');

			// Redirect to index
			header('Location: index.php');
			exit;
		}
	}
}

$user = '';
$email = '';
$password = '';

if (isset($data)) {
	$user = $data['name'];
	$email = $data['email'];
	$password = $data['password'];
}

?>

<?php echo h_head('Sign On', h_css('css/style.css')); ?>

<body>

	<?php
	echo h_header();
	?>

	<form class="m-3 py-2 pb-5 col-10 col-md-4 col-lg-3 mx-auto" method="post">
		<?php
		// Verify if $SESSION['msg'] exists
		if (isset($_SESSION['msg'])) {

			// Print $SESSION['msg']
			echo $_SESSION['msg'];

			// Destroy $SESSION['msg']
			unset($_SESSION['msg']);
		}
		?>
		<h1 class="h3 mb-3 fw-normal">Please sign on</h1>

		<!-- Name input with validation -->
		<div class="form-floating mb-1">
			<input type="text" class="form-control" name="name" id="nameInput" placeholder="name" value="<?php echo $user; ?>">
			<label for="floatingInput">Name</label>

			<!-- Check Name -->
			<span class="position-absolute top-50 end-0 translate-middle ml-3" id="u-check"></span>
		</div>
		<div class="btn-group btn-group-sm w-100 px-auto" role="group">
			<p id="nm-lwcs" class="btn btn-secondary textwhite mb-1">lowercase</p>
			<p id="nm-upcs" class="btn btn-secondary textwhite mb-1">uppercase</p>
		</div>
		<div class="btn-group btn-group-sm w-100 mt-0 pt-0 px-auto" role="group">
			<p id="nm-n" class="btn btn-secondary textwhite">number</p>
			<p id="nm-lgth" class="btn btn-secondary textwhite">length 5+</p>
		</div>

		<!-- Email input with validation -->
		<div class="form-floating mb-1">
			<input type="email" class="form-control" name="email" id="emailInput" placeholder="name@login.com" value="<?php echo $email; ?>">
			<label for="floatingInput">Email address</label>

			<!-- Check Email -->
			<span class="position-absolute top-50 end-0 translate-middle ml-3" id="e-check"></span>
		</div>
		<div class="btn-group btn-group-sm w-100 p-auto mb-3 bg-danger" role="group">
			<p id="email-lwcs" class="btn btn-secondary text-white mb-0">lowercase</p>
			<p id="lwcs" class="btn btn-secondary text-white mb-0">- _</p>
			<p id="lwcs" class="btn btn-secondary text-white mb-0">name@login.com</p>
		</div>

		<!-- Password input with validation -->
		<div class="form-floating mb-1">
			<input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" autocomplete=off value="<?php echo $password; ?>">
			<i class="bi bi-eye-slash p-3 me-3 position-absolute top-50 end-0 translate-middle-y" id="togglePassword"></i>
			<label for="floatingPassword">Password</label>

			<!-- Check Password -->
			<span class="position-absolute top-50 end-0 translate-middle ml-3" id="p-check"></span>
		</div>

		<!-- Checks for password entry -->
		<div class="btn-group btn-group-sm w-100 p-auto mb-1" role="group">
			<p id="pw-lwcs" class="btn btn-danger text-white mb-0">lowercase</p>
			<p id="pw-upcs" class="btn btn-danger text-white mb-0">uppercase</p>
			<p id="pw-n" class="btn btn-danger text-white mb-0">number</p>
		</div>
		<div class="btn-group btn-group-sm w-100 p-auto mb-3" role="group">
			<p id="pw-sym" class="btn btn-danger text-white">symbol</p>
			<p id="pw-lgth" class="btn btn-danger text-white">length 8+</p>
		</div>

		<!-- Submit button -->
		<div class="text-center">
			<button id="submit" class="btn btn-primary w-75 mx-auto py-2 disabled" type="submit">Sign on</button>
			<p class="my-2">Already have an account? <a class="text-decoration-none" href="login.php">Sign in</a></p>
		</div>
	</form>

	<!-- Footer -->
	<?php
	require_once 'footer.php';
	// echo script();
	?>
	<script src="js/script.js"></script>
	<script src="js/form-script.js"></script>
</body>

</html>