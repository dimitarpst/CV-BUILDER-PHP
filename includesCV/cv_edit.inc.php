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
            'graduation_year' => $_POST['graduation_year'],
            'skill_name1' => $_POST['skill_name1'],
            'years_of_exp1' => $_POST['years_of_exp1'],
            'skill_name2' => $_POST['skill_name2'],
            'years_of_exp2' => $_POST['years_of_exp2'],
            'skill_name3' => $_POST['skill_name3'],
            'years_of_exp3' => $_POST['years_of_exp3'],
            'skill_name4' => $_POST['skill_name4'],
            'years_of_exp4' => $_POST['years_of_exp4'],
            'skill_name5' => $_POST['skill_name5'],
            'years_of_exp5' => $_POST['years_of_exp5'],
            'about_me'        => $_POST['about_me']
        ];

        $errors = [];

        if (!has_cv_data_changed($cvId, $cvData, $pdo)) {
            $errors["no_changes"] = "No changes were made to the CV.";
        }

        if (is_input_empty($cvData)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        
        if (is_cvname_invalid($cvData['cvname'])) {
            $errors["invalid_cvname"] = "Invalid CV name used!";
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

        for ($i = 1; $i <= 5; $i++) {
            $skill_name = $cvData['skill_name' . $i];
            if (is_skill_name_between($skill_name)) {
                $errors["invalid_skill_name"] = "Invalid skill name used!";
            }
        }

        for ($i = 1; $i <= 5; $i++) {
            $years_of_exp = $cvData['years_of_exp' . $i];
            if (is_years_of_exp_invalid($years_of_exp)) {
                $errors["invalid_years_of_exp"] = "Invalid years of experience used!";
            }
        }

        if (is_about_me_between($cvData['about_me'])) {
            $errors["invalid_about_me"] = "Invalid about me used!";
        }

        if ($errors) {
            $_SESSION['errors_cv'] = $errors;
            $_SESSION['cv_data'] = $cvData;

            header("Location: ../dashboard.php");
            exit();
        } else {
            try {
                update_cv($pdo, $cvId, $userId, $cvData); 
                $_SESSION["cv_edit_success"] = true;
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