<?php
include '../includes/header.php';
include '../includes/db.php';

$id_kehadiran = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal'];
    $status_absensi = $_POST['status_absensi'];

    $sql = "UPDATE absensi SET 
            id_siswa='$id_siswa', 
            tanggal='$tanggal', 
            status_absensi='$status_absensi'
            WHERE id_kehadiran=$id_kehadiran";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_absensi = "SELECT * FROM absensi WHERE id_kehadiran=$id_kehadiran";
$result_absensi = $conn->query($sql_absensi);
$absensi = $result_absensi->fetch_assoc();

$siswa_sql = "SELECT id_siswa, nama_siswa FROM siswa";
$siswa_result = $conn->query($siswa_sql);
?>

<h2>Edit Absensi</h2>
<form action="update.php?id=<?php echo $id_kehadiran; ?>" method="post">
    <div class="mb-3">
        <label for="id_siswa" class="form-label">Nama Siswa</label>
        <select class="form-control" id="id_siswa" name="id_siswa" required>
            <?php while ($row = $siswa_result->fetch_assoc()) {
                $selected = $row['id_siswa'] == $absensi['id_siswa'] ? 'selected' : '';
                echo "<option value='{$row['id_siswa']}' $selected>{$row['nama_siswa']}</option>";
            } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $absensi['tanggal']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status_absensi" name="status_absensi" required>
            <option value="Hadir" <?php echo $absensi['status_absensi'] == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
            <option value="Sakit" <?php echo $absensi['status_absensi'] == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
            <option value="Izin" <?php echo $absensi['status_absensi'] == 'Izin' ? 'selected' : ''; ?>>Izin</option>
            <option value="Alpa" <?php echo $absensi['status_absensi'] == 'Alpa' ? 'selected' : ''; ?>>Alpa</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
