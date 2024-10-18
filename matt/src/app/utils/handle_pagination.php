<?php
// Include the PDO connection setup from handle_admin_page.php here
include 'db.connection.php';

// Fetch the total number of records
$sql_count = "SELECT COUNT(*) FROM user"; // Replace 'your_table' with your actual table name
$stmt = $pdo->prepare($sql_count);
$stmt->execute();
$total_records = $stmt->fetchColumn();

// Rows per page and current page from POST request
$rowsPerPage = isset($_POST['rowsPerPage']) ? (int)$_POST['rowsPerPage'] : 10;
$page_no = isset($_POST['page_no']) ? (int)$_POST['page_no'] : 1;

$total_pages = ceil($total_records / $rowsPerPage);

// Generate pagination links
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page_no) {
        echo "<span class='current-page'>$i</span> "; // Highlight the current page
    } else {
        echo "<a href='#' class='pagination-link' data-page='$i'>$i</a> ";
    }
}
?>