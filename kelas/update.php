<?php
include '../includes/header.php';
include '../includes/db.php';

$id_kelas = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kelas = $_POST['nama_kelas'];

    // Validasi id_kelas
    $kelas_check_sql = "SELECT id_kelas FROM kelas WHERE id_kelas = $id_kelas";
    $kelas_check_result = $conn->query($kelas_check_sql);

    if ($kelas_check_result->num_rows > 0) {
        $sql = "UPDATE kelas SET nama_kelas='$nama_kelas' WHERE id_kelas=$id_kelas";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Kelas tidak valid.";
    }
}

$sql_kelas = "SELECT * FROM kelas WHERE id_kelas=$id_kelas";
$result_kelas = $conn->query($sql_kelas);
$kelas = $result_kelas->fetch_assoc();
?>

<h2>Edit Kelas</h2>
<form action="update.php?id=<?php echo $id_kelas; ?>" method="post">
    <div class="mb-3">
        <label for="nama_kelas" class="form-label">Nama Kelas</label>
        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?php echo $kelas['nama_kelas']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
