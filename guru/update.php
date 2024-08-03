<?php
include '../includes/header.php';
include '../includes/db.php';

$id_guru = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_guru = $_POST['nama_guru'];
    $nip = $_POST['nip'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    $sql = "UPDATE guru SET 
            nama_guru='$nama_guru', 
            nip='$nip', 
            tanggal_lahir='$tanggal_lahir', 
            alamat='$alamat' 
            WHERE id_guru=$id_guru";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_guru = "SELECT * FROM guru WHERE id_guru=$id_guru";
$result_guru = $conn->query($sql_guru);
$guru = $result_guru->fetch_assoc();
?>

<h2>Edit Guru</h2>
<form action="update.php?id=<?php echo $id_guru; ?>" method="post">
    <div class="mb-3">
        <label for="nama_guru" class="form-label">Nama Guru</label>
        <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?php echo $guru['nama_guru']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $guru['nip']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $guru['tanggal_lahir']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required><?php echo $guru['alamat']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
