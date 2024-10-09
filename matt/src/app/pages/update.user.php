<?php
session_start();
include 'pdo_connection.php'; // Include your PDO connection

// Check if the POST data is set
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['created_at']) && isset($_POST['role'])) {
    // Get the posted data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $created_at = $_POST['created_at'];
    $role = $_POST['role'];

    // Assuming you have a user ID passed in a session or another way
    $user_id = $_SESSION['user_id']; // Or retrieve it another way

    try {
        // Prepare the SQL query to update user information
        $sql = "UPDATE user SET username = :username, email = :email, create_at = :created_at, role = :role WHERE id = :id";
        
        // Prepare statement using PDO
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters to the query
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $user_id);
        
        // Execute the query
        if ($stmt->execute()) {
            echo "User updated successfully!";
        } else {
            echo "Failed to update user.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "All fields are required.";
}
?>
