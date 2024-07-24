<?php
require_once 'dbh.inc.php';
require_once 'login_model.inc.php';

session_start();
$userId = $_SESSION['user_id'];

if (isset($userId)) {
    try {
        if (delete_user($pdo, $userId)) {
            session_unset();
            session_destroy();
            header("Location: ../index.php?userdelete=success");
            exit();
        } else {
            throw new Exception("Failed to delete user.");
        }
    } catch (Exception $e) {
        header("Location: ../index.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../index.php?error=nouserid");
    exit();
}