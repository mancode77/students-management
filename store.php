<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require_once 'controllers.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

	// cek apakah data berhasil di tambahkan atau tidak
	if (store($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Tambah data siswa</title>
	<link rel="stylesheet" href="css/style_user_action.css" />
</head>

<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="" method="post" class="sign-in-form" enctype="multipart/form-data">
					<h2 class="title">Tambah Data Siswa</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Absen" name="absen" required autocomplete="off" autofocus>
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="text" name="nama" placeholder="Nama" autocomplete="off">
					</div>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="jurusan" placeholder="Jurusan" autocomplete="off">
					</div>
					<div class="input-field input-field-rememberme">
						<i class="fas fa-user"></i>
						<input type="file" name="gambar">
					</div>
					<input type="submit" value="Tambah" class="btn solid" name="submit" />
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
						<a style="color: #fff; text-decoration: none;" href="index.php">Back to dashboard</a>
					</button>
				</div>
				<img src="img_style/log.svg" class="image" alt="" />
			</div>
		</div>
	</div>

</body>

</html>