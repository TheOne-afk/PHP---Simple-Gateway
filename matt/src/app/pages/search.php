<?php

include '../utils/db.connection.php';
session_start();
if (isset($_POST['input'])) {
    $inputData = $_POST['input'] . '%'; // Add wildcard for LIKE query

    // Prepare the SQL statement
    $sql = "SELECT * FROM user WHERE username LIKE :input";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':input', $inputData);
    $stmt->execute();

    // Fetch and display the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $row) {
            echo "<p>" . htmlspecialchars($row['username']) . "</p>";
        }
    } else {
        ?>
        t
        <?php
        echo "<p>No results found</p>";
    }
}