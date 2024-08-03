<?php
include ('../includes/header.php');
include ('../includes/db.php');

$id_siswa = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $id_kelas = $_POST['id_kelas'];

    $sql = "UPDATE siswa SET 
            nama_siswa='$nama', 
            nis='$nis', 
            tanggal_lahir='$tanggal_lahir', 
            alamat='$alamat', 
            id_kelas=$id_kelas 
            WHERE id_siswa=$id_siswa";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_siswa = "SELECT * FROM siswa WHERE id_siswa=$id_siswa";
$result_siswa = $conn->query($sql_siswa);
$siswa = $result_siswa->fetch_assoc();

$sql_kelas = "SELECT * FROM kelas";
$result_kelas = $conn->query($sql_kelas);
?>

<h2>Edit Siswa</h2>
<form action="update.php?id=<?php echo $id_siswa; ?>" method="post">
    <div class="mb-3">
        <label for="nama_siswa" class="form-label">Nama Siswa</label>
        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $siswa['nama_siswa']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="nis" class="form-label">NIS</label>
        <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $siswa['nis']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $siswa['tanggal_lahir']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required><?php echo $siswa['alamat']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="id_kelas" class="form-label">Kelas</label>
        <select class="form-control" id="id_kelas" name="id_kelas" required>
            <?php
            if ($result_kelas->num_rows > 0) {
                while ($row_kelas = $result_kelas->fetch_assoc()) {
                    $selected = ($row_kelas['id_kelas'] == $siswa['id_kelas']) ? "selected" : "";
                    echo "<option value='{$row_kelas['id_kelas']}' $selected>{$row_kelas['nama_kelas']}</option>";
                }
            } else {
                echo "<option value=''>Tidak ada kelas</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
