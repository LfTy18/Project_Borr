<?php
include '../includes/header.php';
include '../includes/db.php';

// Ambil data siswa dan mata pelajaran dari database untuk mengisi dropdown
$siswa_query = "SELECT id_siswa, nama_siswa FROM siswa";
$siswa_result = $conn->query($siswa_query);

$mata_pelajaran_query = "SELECT id_mata_pelajaran, nama_mata_pelajaran FROM mata_pelajaran";
$mata_pelajaran_result = $conn->query($mata_pelajaran_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id_siswa = isset($_POST['id_siswa']) ? $_POST['id_siswa'] : null;
    $id_mata_pelajaran = isset($_POST['id_mata_pelajaran']) ? $_POST['id_mata_pelajaran'] : null;
    $tugas = isset($_POST['tugas']) ? $_POST['tugas'] : null;
    $ulangan_harian = isset($_POST['ulangan_harian']) ? $_POST['ulangan_harian'] : null;
    $uts = isset($_POST['uts']) ? $_POST['uts'] : null;
    $uas = isset($_POST['uas']) ? $_POST['uas'] : null;
    
    // Query untuk memasukkan data ke dalam tabel nilai
    $sql = "INSERT INTO nilai (id_siswa, id_mata_pelajaran, tugas, ulangan_harian, uts, uas)
            VALUES ('$id_siswa', '$id_mata_pelajaran', '$tugas', '$ulangan_harian', '$uts', '$uas')";

        // Eksekusi statement
        if ($conn->query($sql) === TRUE) {
           header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
}
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
            <label for="id_mata_pelajaran" class="form-label">Mata Pelajaran</label>
            <select class="form-select" id="id_mata_pelajaran" name="id_mata_pelajaran" required>
                <option value="">Pilih Mata Pelajaran</option>
                <?php
                if ($mata_pelajaran_result->num_rows > 0) {
                    while ($row = $mata_pelajaran_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_mata_pelajaran'] . "'>" . $row['nama_mata_pelajaran'] . "</option>";
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
