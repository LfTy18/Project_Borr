<?php
include '../includes/db.php';

$id_mata_pelajaran = $_GET['id'];

$sql = "DELETE FROM mata_pelajaran WHERE id_mata_pelajaran=$id_mata_pelajaran";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
