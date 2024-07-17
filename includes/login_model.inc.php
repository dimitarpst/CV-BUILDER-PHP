<?php

declare(strict_types= 1);

function get_user_by_username_or_email(object $pdo, string $loginIdentifier)
{
    $query = "SELECT * FROM users WHERE username = :loginIdentifier OR email = :loginIdentifier";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':loginIdentifier', $loginIdentifier);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}