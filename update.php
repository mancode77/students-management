<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require_once 'controllers.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$siswa = query("SELECT * FROM siswa WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

	// cek apakah data berhasil diubah atau tidak
	if (update($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Ubah data siswa</title>
	<link rel="stylesheet" href="css/style_user_action.css" />
</head>

<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="" method="post" class="sign-in-form" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
					<input type="hidden" name="gambarLama" value="<?= $siswa["gambar"]; ?>">
					<h2 class="title">Ubah Data Siswa</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Absen" name="absen" required autocomplete="off" autofocus value="<?= $siswa["absen"]; ?>">
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="text" name="nama" placeholder="Nama" autocomplete="off" value="<?= $siswa["nama"]; ?>">
					</div>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="jurusan" placeholder="Jurusan" autocomplete="off" value="<?= $siswa["jurusan"]; ?>">
					</div>
					<img src="img/<?= $siswa['gambar']; ?>" width="40">
					<div class="input-field input-field-rememberme">
						<i class="fas fa-user"></i>
						<input type="file" name="gambar">
					</div>
					<input type="submit" value="Ubah" class="btn solid" name="submit" />
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