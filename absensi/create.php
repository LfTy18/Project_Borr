<?php
include '../includes/header.php';
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $sql = "INSERT INTO absensi (id_siswa, tanggal, status) 
            VALUES ('$id_siswa', '$tanggal', '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<div class="container">
    <h2>Tambah Absensi</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <label for="id_siswa" class="form-label">Siswa</label>
            <select class="form-select" id="id_siswa" name="id_siswa" required>
                <option value="">Pilih Siswa</option>
                <?php
                if ($siswa_result->num_rows > 0) {
                    while ($row = $siswa_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_siswa'] . "'>" . $row['nama_siswa'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Hadir">Hadir</option>
            <option value="Sakit">Sakit</option>
            <option value="Izin">Izin</option>
            <option value="Alpa">Alpa</option>
        </select>
    </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
