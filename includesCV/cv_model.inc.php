<?php

declare(strict_types=1);

function get_cv_by_user_id(object $pdo, int $user_id) {
    $query = "SELECT * FROM cv_data WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function create_cv(object $pdo, array $cvData) {
    $query = "INSERT INTO cv_data (user_id, cvname, fullname, email, gender, age, phone, job_title, company, start_date, end_date, degree, university, graduation_year, about_me) 
              VALUES (:user_id, :cvname, :fullname, :email, :gender, :age, :phone, :job_title, :company, :start_date, :end_date, :degree, :university, :graduation_year, :about_me)";
    $stmt = $pdo->prepare($query);

    foreach ($cvData as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    $stmt->execute();
} 

function update_cv(object $pdo, int $cvId, int $userId, array $cvData) {
    $query = "UPDATE cv_data SET 
        cvname = :cvname,
        fullname = :fullname,
        email = :email,
        gender = :gender,
        age = :age,
        phone = :phone,
        job_title = :job_title,
        company = :company,
        start_date = :start_date,
        end_date = :end_date,
        degree = :degree,
        university = :university,
        graduation_year = :graduation_year,
        about_me = :about_me  
        WHERE id = :cvId AND user_id = :userId";

    $stmt = $pdo->prepare($query);

    $stmt->bindValue(":cvId", $cvId, PDO::PARAM_INT);
    $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);

    foreach ($cvData as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }
    $stmt->execute();
}

function delete_cv(object $pdo, int $cvId, int $userId) {
    $query = "DELETE FROM cv_data WHERE id = :cvId AND user_id = :userId";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':cvId', $cvId, PDO::PARAM_INT);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
}