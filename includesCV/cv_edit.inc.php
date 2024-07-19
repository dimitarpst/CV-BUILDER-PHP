<?php
session_start();
require_once 'dbh.inc.php';
require_once 'cv_model.inc.php';
require_once 'cv_contr.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cvId']) && is_numeric($_POST['cvId'])) {
        $cvId = (int)$_POST['cvId'];
        $userId = $_SESSION['user_id'];

        $cvData = [
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

        if (!has_cv_data_changed($cvId, $cvData, $pdo)) {
            $errors["no_changes"] = "No changes were made to the CV.";
        }

        if (is_input_empty($cvData)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (is_cvname_duplicate($cvData["cvname"], $cvId, $userId, $pdo)) {
            $errors["duplicate_cvname"] = "There is already a CV with that name!";
        }

        if (is_email_invalid($cvData['email'])) {
            $errors["invalid_email"] = "Invalid email used!";
        }

        if (is_fullname_with_only_letters_and_spaces($cvData["fullname"])) {
            $errors["invalid_fullname"] = "Invalid fullname used!";
        }

        if (is_gender_invalid($cvData["gender"])) {
            $errors["invalid_gender"] = "Invalid gender used!";
        }

        if (is_age_invalid($cvData['age'])) {
            $errors["invalid_age"] = "Invalid age used!";
        }
    
        if (is_phone_invalid($cvData['phone'])) {
            $errors["invalid_phone"] = "Invalid phone used!";
        }
    
        if (is_job_title_between($cvData['job_title'])) {
            $errors["invalid_job_title"] = "Invalid job title used!";
        }
    
        if (is_company_between($cvData['company'])) {
            $errors["invalid_company"] = "Invalid company used!";
        }
 
        if (is_start_date_invalid($cvData['start_date'], $cvData['end_date'])) {
            $errors["invalid_start_date"] = "Invalid start date used!";
        }
      
        if (is_end_date_invalid($cvData['end_date'], $cvData['start_date'])) {
            $errors["invalid_end_date"] = "Invalid end date used!";
        }
    
        if (is_degree_between($cvData['degree'])) {
            $errors["invalid_degree"] = "Invalid degree used!";
        }
    
        if (is_university_between($cvData['university'])) {
            $errors["invalid_university"] = "Invalid university used!";
        }

        if (is_graduation_year_invalid($cvData['graduation_year'])) {
            $errors["invalid_graduation_year"] = "Invalid graduation year used!";
        }

        if ($errors) {
            $_SESSION['errors_cv'] = $errors;
            $_SESSION['cv_data'] = $cvData;

            header("Location: ../dashboard.php");
            exit();
        } else {
            try {
                update_cv($pdo, $cvId, $userId, $cvData); 

                header("Location: ../dashboard.php");
                exit();
            } catch (PDOException $e) {
                error_log("Database Error: " . $e->getMessage());
                header("Location: ../dashboard.php?error=dberror&details=" . urlencode($e->getMessage())); 
                exit();
            }
        }
    } else {
        header("Location: ../dashboard.php?error=invalidcvid");
        exit();
    }
} else {
    header("Location: ../dashboard.php");
    exit();
}