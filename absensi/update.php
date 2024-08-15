<?php
include '../includes/header.php';
include '../includes/db.php';

$siswa_query = "SELECT id_siswa, nama_siswa FROM siswa";
$siswa_result = $conn->query($siswa_query);

$id_absensi = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $sql = "UPDATE absensi SET tanggal='$tanggal', status='$status' WHERE id_absensi=$id_absensi";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_absensi = "SELECT * FROM absensi WHERE id_absensi=$id_absensi";
$result_absensi = $conn->query($sql_absensi);
$absensi = $result_absensi->fetch_assoc();
?>

<h2>Edit Absensi</h2>
<form action="update.php?id=<?php echo $id_absensi; ?>" method="post">
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
        <select class="form-control" id="status" name="status" required>
            <option value="Hadir" <?php echo $absensi['status'] == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
            <option value="Sakit" <?php echo $absensi['status'] == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
            <option value="Izin" <?php echo $absensi['status'] == 'Izin' ? 'selected' : ''; ?>>Izin</option>
            <option value="Alpa" <?php echo $absensi['status'] == 'Alpa' ? 'selected' : ''; ?>>Alpa</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
