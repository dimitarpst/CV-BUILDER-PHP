<?php
declare(strict_types=1);
require_once 'includes/dbh.inc.php'; // Adjusted path to include the database connection
require_once 'cvDisplay_model.inc.php';

function display_cv(int $id) {
    global $pdo; // Use the global $pdo instance
    $cvDetails = get_cv_details_by_id($pdo, $id);
    if ($cvDetails) {
        require 'cvDisplay_view.inc.php';
    } else {
        echo "<p>CV not found.</p>";
    }
}