<?php
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT * FROM siswa";
$result = $conn->query($sql);
?>

<h2>Daftar Siswa</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Siswa</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id_siswa']}</td>
                    <td>{$row['nama_siswa']}</td>
                    <td>{$row['nis']}</td>
                    <td>{$row['tanggal_lahir']}</td>
                    <td>{$row['alamat']}</td>
                    <td>{$row['id_kelas']}</td>
                    <td>
                        <a href='update.php?id={$row['id_siswa']}' class='btn btn-warning'>Edit</a>
                        <a href='delete.php?id={$row['id_siswa']}' class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
include '../includes/footer.php';
?>
