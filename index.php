<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: user_action.php");
	exit;
}

require_once 'controllers.php';
$siswa = query("SELECT * FROM siswa");

// tombol cari ditekan
if (isset($_POST["search"])) {
	$siswa = search($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<title>Admin</title>
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link rel="stylesheet" href="css/style_dashboard.css">
	<link rel="stylesheet" href="css/style_ajax.css">
</head>

<body>
	<input type="checkbox" id="nav-toggle">
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><span class="las la-clinic-medical"></span> <span>School</span></h2>
		</div>
		<!--Secciones-del-tablero-->
		<div class="sidebar-menu">
			<ul>
				<li>
					<a href="" class="active"><span class="las la-home"></span>
						<span>Table</span></a>
				</li>
				<li>
					<a href="logout.php"><span class="las la-book-medical"></span>
						<span>logout</span></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="main-content">
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="las la-bars"></span>
				</label>
				Table
			</h2>
			<form action="" method="post" class="form-cari">
				<div class="search-wrapper">
					<span class="las la-search"></span>
					<input type="text" name="keyword" autofocus placeholder="Search user..." autocomplete="off" id="keyword" />
				</div>
			</form>
			<div class="user-wrapper">
				<img src="img/Avatar.png" width="40px" height="40px" alt="">
				<div>
					<h4>Administrador</h4>
					<small>Super Admin</small>
				</div>
			</div>
		</header>
		<main>
			<div class="cards">
				<div class="card-single">
					<div>
						<h1>12</h1>
						<span>Guru pengampu</span>
					</div>
					<div>
						<span class="las la-users"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>12</h1>
						<span>Guru Terdaftar</span>
					</div>
					<div>
						<span class="las la-stethoscope"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>34</h1>
						<span>Siswa</span>
					</div>
					<div>
						<span class="las la-wheelchair"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>
							<?= count($siswa); ?>
						</h1>
						<span>Siswa Terdaftar</span>
					</div>
					<div>
						<span class="lab la-wpforms"></span>
					</div>
				</div>
			</div>
			<div class="recent-grid">
				<div class="projects">
					<div class="card">
						<div class="card-header">
							<h3>Students</h3>

							<button>
								<a href="store.php" class="tambah">Tambah data siswa</a>
								<span class="las la-arrow-right"></span>
							</button>
						</div>
						<div class="card-body">
							<div class="table-responsive" id="container">
								<table width="100%">
									<?php if ($siswa) : ?>
										<thead>
											<tr>
												<td>No.</th>
												<td>Nama</td>
												<td>Absen</td>
												<td>Jurusan</td>
												<td class="aksi">Aksi</td>
											</tr>
										</thead>

										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($siswa as $row) : ?>
												<tr>
													<td><?= $i; ?></td>
													<td><?= $row["nama"]; ?></td>
													<td><?= $row["absen"]; ?></td>
													<td><?= $row["jurusan"]; ?></td>
													<!-- <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td> -->
													<td class="aksi">
														<a href="update.php?id=<?= $row["id"]; ?>">ubah</a> |
														<a href="destroy.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
													</td>
												</tr>
												<?php $i++; ?>
											<?php endforeach; ?>
										<?php else : ?>
											<?= "<h1>Data tidak tersedia</h1>"; ?>
										<?php endif ?>
										</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="customers">
					<div class="card">
						<div class="card-header">
							<h3>Profile</h3>

							<button>
								<?= count($siswa); ?>
								Aktif
								<span class="las la-arrow-right">
								</span>
							</button>
						</div>

						<div class="card-body">
							<?php foreach ($siswa as $row) : ?>
								<div class="customer">
									<div class="info">
										<img src="img/<?= $row["gambar"]; ?>" width="40px" height="40px" alt="">
										<div>
											<h4>
												<?= $row["nama"]; ?>
											</h4>
											<small>Aktif</small>
										</div>
									</div>
									<div class="contact">
										<span class="las la-user-circle"></span>
										<span class="lab la-whatsapp"></span>
										<span class="las la-phone"></span>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script src=" js/script.js"></script>
</body>

</html>