<?php
include '../includes/header.php';
include '../includes/db.php';

// Ambil data siswa dari database untuk mengisi dropdown
$siswa_query = "SELECT id_siswa, nama_siswa FROM siswa";
$siswa_result = $conn->query($siswa_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id_siswa = isset($_POST['id_siswa']) ? $_POST['id_siswa'] : null;
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
    $status_kehadiran = isset($_POST['status_kehadiran']) ? $_POST['status_kehadiran'] : null;

    // Validasi input
    if ($id_siswa && $tanggal && $status_kehadiran !== null) {
        // Query untuk memasukkan data ke dalam tabel absensi
        $sql = "INSERT INTO absensi (id_siswa, tanggal, status_kehadiran) VALUES (?, ?, ?)";

        // Persiapkan statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $id_siswa, $tanggal, $status_kehadiran);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Data absensi berhasil disimpan.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Data tidak lengkap.";
    }
}

// Tutup koneksi
$conn->close();
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
        <select class="form-control" id="status_absensi" name="status_absensi" required>
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
