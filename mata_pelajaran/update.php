<?php
include '../includes/header.php';
include '../includes/db.php';

$id_mata_pelajaran = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mata_pelajaran = $_POST['nama_mata_pelajaran'];
    $id_guru = $id_guru['$id_guru'];

    $sql = "UPDATE mata_pelajaran SET 
            nama_mata_pelajaran='$nama_mata_pelajaran' ,
            id_guru='$id_guru'
            WHERE id_mata_pelajaran=$id_mata_pelajaran";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_mata_pelajaran = "SELECT * FROM mata_pelajaran WHERE id_mata_pelajaran=$id_mata_pelajaran";
$result_mata_pelajaran = $conn->query($sql_mata_pelajaran);
$mata_pelajaran = $result_mata_pelajaran->fetch_assoc();

$guru_sql = "SELECT id_guru, nama_guru FROM guru";
$guru_result = $conn->query($guru_sql);
?>


<h2>Edit Mata Pelajaran</h2>
<form action="update.php?id=<?php echo $id_mata_pelajaran; ?>" method="post">
    <div class="mb-3">
        <label for="nama_mata_pelajaran" class="form-label">Nama Mata Pelajaran</label>
        <input type="text" class="form-control" id="nama_mata_pelajaran" name="nama_mata_pelajaran" value="<?php echo $mata_pelajaran['nama_mata_pelajaran']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="id_guru" class="form-label">Guru Pengampu</label>
        <select class="form-control" id="id_guru" name="id_guru" required>
            <?php while ($row = $guru_result->fetch_assoc()) {
                $selected = $row['id_guru'] == $mata_pelajaran['id_guru'] ? 'selected' : '';
                echo "<option value='{$row['id_guru']}' $selected>{$row['nama_guru']}</option>";
            } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
