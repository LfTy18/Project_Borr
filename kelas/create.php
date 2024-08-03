<?php
include '../includes/header.php';
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kelas = $_POST['nama_kelas'];
    
    // Validasi id_kelas
    $kelas_check_sql = "SELECT id_kelas FROM kelas WHERE nama_kelas = '$nama_kelas'";
    $kelas_check_result = $conn->query($kelas_check_sql);

    if ($kelas_check_result->num_rows == 0) {
    $sql = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}


?>

<h2>Tambah Kelas</h2>
<form action="create.php" method="post">
    <div class="mb-3">
        <label for="nama_kelas" class="form-label">Nama Kelas</label>
        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
