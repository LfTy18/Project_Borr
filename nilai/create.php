<?php
include '../includes/header.php';
include '../includes/db.php';

// Ambil data siswa dan mata pelajaran dari database untuk mengisi dropdown
$siswa_query = "SELECT id_siswa, nama_siswa FROM siswa";
$siswa_result = $conn->query($siswa_query);

$mapel_query = "SELECT id_mapel, nama_mapel FROM mata_pelajaran";
$mapel_result = $conn->query($mapel_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id_siswa = isset($_POST['id_siswa']) ? $_POST['id_siswa'] : null;
    $id_mapel = isset($_POST['id_mapel']) ? $_POST['id_mapel'] : null;
    $tugas = isset($_POST['tugas']) ? $_POST['tugas'] : null;
    $ulangan_harian = isset($_POST['ulangan_harian']) ? $_POST['ulangan_harian'] : null;
    $uts = isset($_POST['uts']) ? $_POST['uts'] : null;
    $uas = isset($_POST['uas']) ? $_POST['uas'] : null;

    // Validasi input
    if ($id_siswa && $id_mapel && $tugas !== null && $ulangan_harian !== null && $uts !== null && $uas !== null) {
        // Ambil nilai kehadiran dari tabel absensi
        $kehadiran_query = "SELECT AVG(status_absensi) as nilai_kehadiran FROM absensi WHERE id_siswa = ? AND id_mapel = ?";
        $stmt_kehadiran = $conn->prepare($kehadiran_query);
        $stmt_kehadiran->bind_param("ii", $id_siswa, $id_mapel);
        $stmt_kehadiran->execute();
        $result_kehadiran = $stmt_kehadiran->get_result();
        $nilai_kehadiran = $result_kehadiran->fetch_assoc()['nilai_kehadiran'];
        $stmt_kehadiran->close();

        // Jika nilai kehadiran tidak ditemukan, beri nilai default 0
        if ($nilai_kehadiran === null) {
            $nilai_kehadiran = 0;
        }

        // Query untuk memasukkan data ke dalam tabel nilai
        $sql = "INSERT INTO nilai (id_siswa, id_mapel, nilai_kehadiran, tugas, ulangan_harian, uts, uas)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Persiapkan statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiiii", $id_siswa, $id_mapel, $nilai_kehadiran, $tugas, $ulangan_harian, $uts, $uas);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Data nilai berhasil disimpan.";
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
    <h2>Tambah Nilai</h2>
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
            <label for="id_mapel" class="form-label">Mata Pelajaran</label>
            <select class="form-select" id="id_mapel" name="id_mapel" required>
                <option value="">Pilih Mata Pelajaran</option>
                <?php
                if ($mapel_result->num_rows > 0) {
                    while ($row = $mapel_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_mapel'] . "'>" . $row['nama_mapel'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nilai_tugas" class="form-label">Nilai Tugas</label>
            <input type="number" class="form-control" id="tugas" name="tugas" required>
        </div>
        <div class="mb-3">
            <label for="nilai_ulangan_harian" class="form-label">Nilai Ulangan Harian</label>
            <input type="number" class="form-control" id="ulangan_harian" name="ulangan_harian" required>
        </div>
        <div class="mb-3">
            <label for="nilai_uts" class="form-label">Nilai UTS</label>
            <input type="number" class="form-control" id="uts" name="uts" required>
        </div>
        <div class="mb-3">
            <label for="nilai_uas" class="form-label">Nilai UAS</label>
            <input type="number" class="form-control" id="uas" name="uas" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>


<?php 
include '../includes/footer.php';
?>
