<?php

declare(strict_types= 1);

function get_username(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email) 
{
    $query = "SELECT email FROM users WHERE email = :email";
    $stnt = $pdo->prepare($query);
    $stnt->bindValue(':email', $email);
    $stnt->execute();
    
    $result = $stnt->fetch(PDO::FETCH_ASSOC);
    return $result;      
}

function set_user(object $pdo, string $username, string $email, string $pwd)
{
    $query = "INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd);";
    $stnt = $pdo->prepare($query);

    $options = ['cost' => 12];
    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stnt->bindValue(":username", $username);
    $stnt->bindValue(":email", $email);
    $stnt->bindValue(":pwd", $hashedpwd);
    $stnt->execute();
}

