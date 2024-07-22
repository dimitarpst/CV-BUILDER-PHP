<?php
declare(strict_types=1);

require_once 'includes/dbh.inc.php';

function get_cv_details_by_id(PDO $pdo, int $id): ?array {
    $query = "SELECT * FROM cv_data WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result : null;
}