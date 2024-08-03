<?php
include '../includes/header.php';
include '../includes/db.php';

$id_nilai = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kehadiran = $_POST['kehadiran'];
    $tugas = $_POST['tugas'];
    $ulangan_harian = $_POST['ulangan_harian'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];

    $sql = "UPDATE nilai SET kehadiran='$kehadiran', tugas='$tugas', ulangan_harian='$ulangan_harian', uts='$uts', uas='$uas' WHERE id_nilai=$id_nilai";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_nilai = "SELECT * FROM nilai WHERE id_nilai=$id_nilai";
$result_nilai = $conn->query($sql_nilai);
$nilai = $result_nilai->fetch_assoc();
?>

<h2>Edit Nilai Siswa</h2>
<form action="update.php?id=<?php echo $id_nilai; ?>" method="post">
    <div class="mb-3">
        <label for="kehadiran" class="form-label">Kehadiran</label>
        <input type="text" class="form-control" id="kehadiran" name="kehadiran" value="<?php echo $nilai['kehadiran']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="tugas" class="form-label">Tugas</label>
        <input type="text" class="form-control" id="tugas" name="tugas" value="<?php echo $nilai['tugas']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="ulangan_harian" class="form-label">Ulangan Harian</label>
        <input type="text" class="form-control" id="ulangan_harian" name="ulangan_harian" value="<?php echo $nilai['ulangan_harian']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="uts" class="form-label">UTS</label>
        <input type="text" class="form-control" id="uts" name="uts" value="<?php echo $nilai['uts']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="uas" class="form-label">UAS</label>
        <input type="text" class="form-control" id="uas" name="uas" value="<?php echo $nilai['uas']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
