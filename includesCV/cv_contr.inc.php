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

