<?php
include '../includes/config.php';

try {
    $userName = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = :user_name");
    $stmt->bindParam(':user_name', $userName);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Username already exists
        echo json_encode(["status" => "error", "message" => "Duplicate entry"]);
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (user_name, first_name, middle_name, last_name, password, role) VALUES (:user_name, :first_name, :middle_name, :last_name, :password, :role)");
        $stmt->bindParam(':user_name', $userName);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':middle_name', $middleName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        echo json_encode(["status" => "success", "message" => "Account added successfully"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
