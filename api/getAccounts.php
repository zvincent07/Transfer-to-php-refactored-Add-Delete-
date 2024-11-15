<?php
include '../includes/config.php';

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$accounts = $stmt->fetchAll();

echo json_encode($accounts); // Return the data in JSON format
?>
