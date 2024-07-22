<?php

declare(strict_types= 1);

function is_input_empty(array $cvData): bool 
{
    foreach ($cvData as $key => $field) {
        if (strpos($key, 'skill_name') !== false || strpos($key, 'years_of_exp') !== false) {
            continue;
        }

        if (empty($field)) {
            return true; 
        }
    }
    return false; 
}

function is_cvname_invalid(string $cvname) 
{
    if (!preg_match("/^.{1,16}$/", $cvname)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) 
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else{ 
        return false;
    }
}

function is_fullname_with_only_letters_and_spaces(string $fullname) 
{
    if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
        return true;
    } else {
        return false;
    }
}

function is_gender_invalid(string $gender){
    if($gender === "male" || $gender === "female" || $gender === "other") {
        return false;
    } else {
        return true;
    }
} 

function is_age_invalid(string $age) 
{
    if (!preg_match("/^[0-9]{1,2}$/", $age)) {
        return true;
    } else {
        return false;
    }
}

function is_phone_invalid(string $phone) 
{
    if (!preg_match('/^\+?[0-9]{7,14}$/', $phone)) {
        return true;
    } else {
        return false;
    }
}

function is_job_title_between(string $job_title) 
{
    if (!preg_match("/^.{1,255}$/", $job_title)) {
        return true;
    } else {
        return false;
    }
}

function is_company_between(string $company) 
{
    if (!preg_match("/^.{1,255}$/", $company)) {
        return true;
    } else {
        return false;
    }
}

function is_start_date_invalid(string $start_date, string $end_date) 
{
    if ($start_date > $end_date) {
        return true;
    } else {
        return false;
    }
}

function is_end_date_invalid(string $end_date, string $start_date) 
{
    if ($end_date < $start_date) {
        return true;
    } else {
        return false;
    }
}

function is_degree_between(string $degree)
{
    if (!preg_match("/^.{1,255}$/", $degree)) {
        return true;
    } else {
        return false;
    }
}

function is_university_between(string $university)
{
    if (!preg_match("/^.{1,255}$/", $university)) {
        return true;
    } else {
        return false;
    }
}

function is_graduation_year_invalid(string $graduation_year) 
{
    if (!preg_match("/^[0-9]{4}$/", $graduation_year)) {
        return true;
    } else {
        return false; 
    }
}
function is_skill_name_between(string $skill_name) 
{
    if (!preg_match("/^.{0,255}$/", $skill_name)) {
        return true;
    } else {
        return false;
    }
}
function is_years_of_exp_invalid(string $years_of_exp) 
{
    if (!preg_match("/^[0-9]{1,2}$/", $years_of_exp)) {
        return true;
    } else {
        return false;
    }
}

function is_about_me_between(string $company) 
{
    if (!preg_match("/.{1,512}/", $company)) {
        return true;
    } else {
        return false;
    }
}

function has_cv_data_changed(int $cvId, array $newCvData, PDO $pdo): bool {
    $stmt = $pdo->prepare("SELECT * FROM cv_data WHERE id = :cv_id");
    $stmt->execute(['cv_id' => $cvId]);
    $currentCvData = $stmt->fetch(PDO::FETCH_ASSOC);
    foreach ($newCvData as $key => $value) {
        if (array_key_exists($key, $currentCvData) && $currentCvData[$key] != $value) {
            return true; 
        }
    }
    return false;
}
function is_cvname_duplicate(string $cvname, int $cvId, int $userId, PDO $pdo): bool {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cv_data WHERE cvname = :cvname AND id != :cv_id AND user_id = :user_id");
    $stmt->execute(['cvname' => $cvname, 'cv_id' => $cvId, 'user_id' => $userId]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

function check_cv_errors()
{
    if (isset($_SESSION["errors_cv"]) && !empty($_SESSION["errors_cv"])) {
        $errors = $_SESSION["errors_cv"];

        $errorMessages = array_values($errors);

        echo '<script>
            window.addEventListener("load", function() {
                showErrorMessage(' . json_encode($errorMessages) . ');
            });
        </script>';
        unset($_SESSION["errors_cv"]);
    } 
}

function cv_create_success()
{
    if (isset($_SESSION["cv_create_success"])) {
        echo '<script>
            window.addEventListener("load", function() {
                showSuccessMessage("CV created successfully");
            });
        </script>';
        unset($_SESSION["cv_create_success"]);
    }
}
function cv_edit_success()
{
    if (isset($_SESSION["cv_edit_success"])) {
        echo '<script>
            window.addEventListener("load", function() {
                showSuccessMessage("CV edited successfully");
            });
        </script>';
        unset($_SESSION["cv_edit_success"]);
    }
}

function cv_delete_success()
{
    if (isset($_SESSION["cv_delete_success"])) {
        echo '<script>
            window.addEventListener("load", function() {
                showSuccessMessage("CV deleted successfully");
            });
        </script>';
        unset($_SESSION["cv_delete_success"]);
    }
}