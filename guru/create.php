<?php
include '../includes/header.php';
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_guru = $_POST['nama_guru'];
    $nip = $_POST['nip'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO guru (nama_guru, nip, tanggal_lahir, alamat) 
            VALUES ('$nama_guru', '$nip', '$tanggal_lahir', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Tambah Guru</h2>
<form action="create.php" method="post">
    <div class="mb-3">
        <label for="nama_guru" class="form-label">Nama Guru</label>
        <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
    </div>
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
