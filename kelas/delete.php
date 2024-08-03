<?php
include '../includes/db.php';

$id_kelas = $_GET['id'];

$sql = "DELETE FROM kelas WHERE id_kelas=$id_kelas";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
