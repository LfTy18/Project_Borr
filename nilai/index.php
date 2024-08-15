<?php
include '../includes/header.php';
include '../includes/db.php';


$sql = "SELECT nilai.*, siswa.nama_siswa, mata_pelajaran.nama_mata_pelajaran
        FROM nilai
        JOIN siswa ON nilai.id_siswa = siswa.id_siswa 
        JOIN mata_pelajaran ON nilai.id_mata_pelajaran = mata_pelajaran.id_mata_pelajaran";

$result = $conn->query($sql);

function hitungNilaiTotal($tugas, $ulangan_harian, $uts, $uas) {
    $nilai_total = ($tugas * 0.20) + ($ulangan_harian * 0.20) + ($uts * 0.25) + ($uas * 0.25);
    return $nilai_total;
}
?>

<h2>Daftar Nilai Siswa</h2>
<a href="create.php" class="btn btn-primary">Tambah Nilai</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Siswa</th>
            <th>Mata Pelajaran</th>
            <th>Tugas</th>
            <th>Ulangan Harian</th>
            <th>UTS</th>
            <th>UAS</th>
            <th>Nilai Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_nilai']; ?></td>
                <td><?php echo $row['nama_siswa']; ?></td>
                <td><?php echo $row['nama_mata_pelajaran']; ?></td>
                <td><?php echo $row['tugas']; ?></td>
                <td><?php echo $row['ulangan_harian']; ?></td>
                <td><?php echo $row['uts']; ?></td>
                <td><?php echo $row['uas']; ?></td>
                <td><?php echo hitungNilaiTotal($row['tugas'], $row['ulangan_harian'], $row['uts'], $row['uas']); ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id_nilai']; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id_nilai']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus nilai ini?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$conn->close();
include '../includes/footer.php';
?>
