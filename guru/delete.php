<?php
include '../includes/db.php';

$id_guru = $_GET['id'];

$sql = "DELETE FROM guru WHERE id_guru = $id_guru";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
