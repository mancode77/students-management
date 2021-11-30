<?php
usleep(500000);
require_once '../controllers.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM siswa
            WHERE
          nama LIKE '%$keyword%' OR
          absen LIKE '%$keyword%' OR
          jurusan LIKE '%$keyword%'
        ";
$siswa = query($query);
?>

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
                    <td class="aksi">
                        <a href="update.php?id=<?= $row["id"]; ?>">ubah</a> |
                        <a href="destroy.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <?= "<td><h3>Data tidak tersedia</h3></td>"; ?>
        <?php endif ?>
</table>