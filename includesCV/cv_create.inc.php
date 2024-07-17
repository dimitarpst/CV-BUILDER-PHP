<?php
session_start();
require_once 'cv_contr.inc.php';
require_once 'dbh.inc.php';
require_once 'cv_model.inc.php';
require_once 'cv_contr.inc.php';  

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cvData = [
        'user_id'        => $_SESSION['user_id'],
        'cvname'          => $_POST['cvname'],
        'fullname'        => $_POST['fullname'],
        'email'           => $_POST['email'],
        'gender'          => $_POST['gender'],
        'age'             => $_POST['age'],
        'phone'           => $_POST['phone'],
        'job_title'       => $_POST['job_title'],
        'company'         => $_POST['company'],
        'start_date'      => $_POST['start_date'],
        'end_date'        => $_POST['end_date'],
        'degree'          => $_POST['degree'],
        'university'      => $_POST['university'],
        'graduation_year' => $_POST['graduation_year']
    ];

    $errors = [];

    if (is_input_empty($cvData)) {
        $errors["empty_input"] = "Fill in all fields!";
    }

    if (is_email_invalid($cvData['email'])) {
        $errors["invalid_email"] = "Invalid email used!";
    }

    if ($errors) {
        $_SESSION['errors_cv'] = $errors;
        $_SESSION['cv_data'] = $cvData;

        header("Location: ../dashboard.php");
    } else {
        try {
            create_cv($pdo, $cvData);
                header("Location: ../dashboard.php");    
            exit();
        } catch (PDOException $e) {
            $errors['db_error'] = "Database error: " . $e->getMessage();
            $_SESSION['errors_cv'] = $errors;
            header("Location: ../dashboard.php");
            exit();
        }
    }
} else {
    header("Location: ../dashboard.php");
    exit();
}