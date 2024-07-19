<?php
session_start();
require_once 'dbh.inc.php';
require_once 'cv_model.inc.php';

if (isset($_POST['cvId']) && is_numeric($_POST['cvId'])) {
    $cvId = (int)$_POST['cvId'];
    $userId = $_SESSION['user_id'];

    try {
        delete_cv($pdo, $cvId, $userId);
        //display success message    
        header("Location: ../dashboard.php");
        exit();
    } catch (PDOException $e) {
        header("Location: ../dashboard.php?error=&details=" . urlencode($e->getMessage())); 
        die("Error deleting CV: " . $e->getMessage()); 
    }
} else {
    header("Location: ../dashboard.php?error=invalidcvid");
    exit();
}
