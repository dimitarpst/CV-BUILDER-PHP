<?php

declare(strict_types= 1);

function is_input_empty(string $username, string $email, string $pwd, string $pwdRepeat) 
{
    if (empty($username) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
        return true;
    } else{ 
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

function is_username_taken(object $pdo,string $username) 
{
    if (get_username($pdo, $username) ) {
        return true;
    } else{ 
        return false;
    }
}

function is_email_registered(object $pdo,string $email) 
{
    if (get_email($pdo, $email)) {
        return true;
    } else{ 
        return false;
    }
}
function do_passwords_match(string $pwd, string $pwdRepeat)
{
    if ($pwd !== $pwdRepeat){
        return false;
    }else{
        return true;
    }
}
function create_user(object $pdo, string $username, string $email, string $pwd) 
{
    set_user($pdo, $username, $email, $pwd);
}