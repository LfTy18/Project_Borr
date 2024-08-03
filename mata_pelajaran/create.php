<?php
include '../includes/header.php';
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mata_pelajaran = $_POST['nama_mapel'];
    $id_guru = $_POST['id_guru'];

    // Validasi id_guru
    $guru_check_sql = "SELECT id_guru FROM guru WHERE id_guru = '$id_guru'";
    $guru_check_result = $conn->query($guru_check_sql);

        if ($guru_check_result->num_rows > 0) {   
        $sql = "INSERT INTO mata_pelajaran (nama_mapel, id_guru) VALUES ('$nama_mata_pelajaran', '$id_guru')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    } 
    
    

$guru_sql = "SELECT id_guru, nama_guru FROM guru";
$guru_result = $conn->query($guru_sql);
?>

<h2>Tambah Mata Pelajaran</h2>
<form action="create.php" method="post">
    <div class="mb-3">
        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
    </div>
    <div class="mb-3">
        <label for="id_guru" class="form-label">Guru Pengampu</label>
        <select class="form-control" id="id_guru" name="id_guru" required>
            <?php while($row = $guru_result->fetch_assoc()) {
                echo "<option value='{$row['id_guru']}'>{$row['nama_guru']}</option>";
            } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>

<?php
$conn->close();
include '../includes/footer.php'
?>