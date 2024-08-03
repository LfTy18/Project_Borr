<?php
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT * FROM mata_pelajaran";
$result = $conn->query($sql);
?>

<h2>Daftar Mata Pelajaran</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Mata Pelajaran</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Mata Pelajaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id_mapel']}</td>
                    <td>{$row['nama_mapel']}</td>
                    <td>{$row['id_guru']}</td>
                    <td>
                        <a href='update.php?id={$row['id_mapel']}' class='btn btn-success'>Edit</a>
                        <a href='delete.php?id={$row['id_mapel']}' class='btn btn-danger'>Hapus</a>                    
                    </td>
                    </tr>";    
        }
    } else {
        echo "<tr><td colspan='3'>Tidak Ada Data</td></tr>";
    }
    ?>
    </tbody>
</table>

<?php
$conn->close();
include '../includes/footer.php';
?>