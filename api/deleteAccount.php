<?php
include '../includes/config.php';

if (isset($_GET['user_name'])) {
    $userName = $_GET['user_name'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_name = :user_name");
    $stmt->bindParam(':user_name', $userName);
    if ($stmt->execute()) {
        echo "Account deleted successfully.";
    } else {
        echo "Error deleting account.";
    }
} else {
    echo "Invalid request.";
}
?>
