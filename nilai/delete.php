<?php
include '../includes/db.php';

$id_nilai = $_GET['id'];

$sql = "DELETE FROM nilai WHERE id_nilai=$id_nilai";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
