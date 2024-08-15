<?php
include '../includes/db.php';

$id_absensi = $_GET['id'];

$sql = "DELETE FROM absensi WHERE id_absensi=$id_absensi";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
