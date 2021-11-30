<?php
session_start();
require_once 'controllers.php';

//register
if (isset($_POST["register"])) {
	if (registration($_POST) > 0) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
				window.location = 'index.php';
			</script>";
	} else {
		echo mysqli_error($conn);
	}
}

//login

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}


if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if (mysqli_num_rows($result) === 1) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if (isset($_POST['remember'])) {
				// buat cookie
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time() + 60);
			}

			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style_user_action.css" />
	<title>Sign in & Sign up Form</title>
</head>

<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="" method="post" class="sign-in-form">
					<h2 class="title">Sign in</h2>
					<?php if (isset($error)) : ?>
						<p style="color: red; font-style: italic;">username / password salah</p>
					<?php endif; ?>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Username" name="username" autocomplete="off" autofocus required/>
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="password" required/>
					</div>
					<div class="input-field input-field-rememberme">
						<i><input type="checkbox" name="remember" id="remember" /></i>
						<label for="remember"><i>remeber me</i></label>
					</div>
					<input type="submit" value="Login" class="btn solid" name="login" />
					<p class="social-text">Or Sign in with social platforms</p>
					<div class="social-media">
						<a href="#" class="social-icon">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-google"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</div>
				</form>
				<form action="" method="post" class="sign-up-form">
					<h2 class="title">Sign up</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Username" name="username" autocomplete="off" autofocus required/>
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="password" required/>
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password Confirm" name="password2" required/>
					</div>
					<input type="submit" class="btn" value="Sign up" name="register" />
					<p class="social-text">Or Sign up with social platforms</p>
					<div class="social-media">
						<a href="#" class="social-icon">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-google"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</div>
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>New here ?</h3>
					<p>
						Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
						ex ratione. Aliquid!
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Sign up
					</button>
				</div>
				<img src="img_style/log.svg" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>One of us ?</h3>
					<p>
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
						laboriosam ad deleniti.
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Sign in
					</button>
				</div>
				<img src="img_style/register.svg" class="image" alt="" />
			</div>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="js/script.js"></script>
</body>

</html>