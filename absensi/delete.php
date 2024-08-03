<?php
include '../includes/db.php';

$id_kehadiran = $_GET['id'];

$sql = "DELETE FROM absensi WHERE id_kehadiran=$id_kehadiran";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
