<?php
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT absensi.id_kehadiran, siswa.nama_siswa, absensi.tanggal, absensi.status_absensi 
        FROM absensi 
        JOIN siswa ON absensi.id_siswa = siswa.id_siswa";

$result = $conn->query($sql);
?>

<h2>Daftar Absensi</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Absensi</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Siswa</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id_kehadiran']}</td>
                    <td>{$row['nama_siswa']}</td>
                    <td>{$row['tanggal']}</td>
                    <td>{$row['status_absensi']}</td>
                    <td>
                        <a href='update.php?id={$row['id_kehadiran']}' class='btn btn-warning'>Edit</a>
                        <a href='delete.php?id={$row['id_kehadiran']}' class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
include '../includes/footer.php';
?>
