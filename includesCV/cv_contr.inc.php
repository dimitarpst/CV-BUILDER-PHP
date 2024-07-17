<?php

declare(strict_types= 1);

function is_input_empty(array $cvData): bool 
{
    foreach ($cvData as $field) {
        if (empty($field)) {
            return true; 
        }
    }
    return false; 
}

function is_email_invalid(string $email) 
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else{ 
        return false;
    }
}
/*
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
    if (!preg_match("/^{1,15}$/", $phone)) {
        return true;
    } else {
        return false;
    }
}
function is_job_title_between(string $job_title) 
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $job_title)) {
        return true;
    } else {
        return false;
    }
}

function is_company_between(string $company) 
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $company)) {
        return true;
    } else {
        return false;
    }
}

function is_degree_between(string $degree)
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $degree)) {
        return true;
    } else {
        return false;
    }
}

function is_university_between(string $university)
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $university)) {
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

function is_graduation_year_invalid(string $graduation_year) 
{
    if (!preg_match("/^[0-9]{4}$/", $graduation_year)) {
        return true;
    } else {
        return false;
    }
}
*/
/*i want to add error handling:
        cvname - no error handling needed
        fullname = Has to be only letters and spaces, no numbers or special characters
        email - already has error handling(is_email_invalid(string $email))
        gender = has to be one of the three options
        age = has to be 2 characters at max(except 0) and only numbers
        phone = :phone, has to be 15 characters at max
        job_title = has to be 255 characters at max, no special characters
        company = has to be 255 characters at max
        start_date = has to be a date in the format YYYY-MM-DD, that's before the end_date
        end_date = has to be a date in the format YYYY-MM-DD, that's after the start_date
        degree = has to be 255 characters at max
        university = has to be 255 characters at max
        graduation_year = has to be a number, 4 characters at max
*/


function is_fullname_with_only_letters_and_spaces(string $fullname) 
{
    if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
        return true;
    } else {
        return false;
    }
}
/*
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
    if (!preg_match("/^{1,15}$/", $phone)) {
        return true;
    } else {
        return false;
    }
}
function is_job_title_between(string $job_title) 
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $job_title)) {
        return true;
    } else {
        return false;
    }
}

function is_company_between(string $company) 
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $company)) {
        return true;
    } else {
        return false;
    }
}

function is_degree_between(string $degree)
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $degree)) {
        return true;
    } else {
        return false;
    }
}

function is_university_between(string $university)
{
    if (!preg_match("/^[a-zA-Z ]{1,255}$/", $university)) {
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

function is_graduation_year_invalid(string $graduation_year) 
{
    if (!preg_match("/^[0-9]{4}$/", $graduation_year)) {
        return true;
    } else {
        return false;
    }
}

*/
/*i want to add error handling:
        cvname - no error handling needed
        fullname = Has to be only letters and spaces, no numbers or special characters
        email - already has error handling(is_email_invalid(string $email))
        gender = has to be one of the three options
        age = has to be 2 characters at max(except 0) and only numbers
        phone = :phone, has to be 15 characters at max
        job_title = has to be 255 characters at max, no special characters
        company = has to be 255 characters at max
        start_date = has to be a date in the format YYYY-MM-DD, that's before the end_date
        end_date = has to be a date in the format YYYY-MM-DD, that's after the start_date
        degree = has to be 255 characters at max
        university = has to be 255 characters at max
        graduation_year = has to be a number, 4 characters at max
*/


