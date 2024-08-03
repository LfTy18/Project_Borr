<?php
include '../includes/db.php';

$id_siswa = $_GET['id'];

$sql = "DELETE FROM siswa WHERE id_siswa=$id_siswa";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
