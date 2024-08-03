<?php
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT * FROM kelas";
$result = $conn->query($sql);
?>

<h2>Daftar Kelas</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Kelas</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Kelas</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id_kelas']}</td>
                    <td>{$row['nama_kelas']}</td>
                    <td>
                        <a href='update.php?id={$row['id_kelas']}' class='btn btn-warning'>Edit</a>
                        <a href='delete.php?id={$row['id_kelas']}' class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
include '../includes/footer.php';
?>