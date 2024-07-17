<?php
session_start();
require_once 'dbh.inc.php';
require_once 'cv_model.inc.php';

if (isset($_POST['cvId']) && is_numeric($_POST['cvId'])) {
    $cvId = (int)$_POST['cvId'];
    $userId = $_SESSION['user_id'];

    try {
        delete_cv($pdo, $cvId, $userId);  
        header("Location: ../dashboard.php?success=cvdeleted");
        exit();
    } catch (PDOException $e) {
        // Handle database errors, perhaps with a flash message or redirection
        die("Error deleting CV: " . $e->getMessage()); 
    }
} else {
    header("Location: ../dashboard.php?error=invalidcvid");
    exit();
}

// Add a delete_cv function to your cv_model.inc.php file
function delete_cv(object $pdo, int $cvId, int $userId) {
    $query = "DELETE FROM cv_data WHERE id = :cvId AND user_id = :userId";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':cvId', $cvId, PDO::PARAM_INT);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
}