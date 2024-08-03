<?php
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT * FROM guru";
$result = $conn->query($sql);
?>

<h2>Daftar Guru</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Guru</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id_guru']}</td>
                    <td>{$row['nama_guru']}</td>
                    <td>{$row['nip']}</td>
                    <td>{$row['tanggal_lahir']}</td>
                    <td>{$row['alamat']}</td>
                    <td>
                        <a href='update.php?id={$row['id_guru']}' class='btn btn-warning'>Edit</a>
                        <a href='delete.php?id={$row['id_guru']}' class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
include '../includes/footer.php';
?>
