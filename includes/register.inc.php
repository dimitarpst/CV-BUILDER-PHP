<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username']; 
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    try {
        require_once 'dbh.inc.php';
        require_once 'register_model.inc.php';
        require_once 'register_contr.inc.php';
        
        //ERROR HANDLE
        $errors = [];


        if (is_input_empty($username, $email, $pwd, $_POST['pwdrepeat'])) { 
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }

        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        if (is_input_empty($username, $email, $pwd, $_POST['pwdrepeat'])) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (!do_passwords_match($pwd, $_POST['pwdrepeat'])) {
            $errors["password_mismatch"] = "Passwords do not match!";
        }
        
        require_once 'config_session.inc.php';
 
        if ($errors) {
            $_SESSION['errors_register'] = $errors;
            $registerData = [
                'username' => $username,
                'email' => $email
            ];
            $_SESSION['register_data'] = $registerData;
        } else { 
            create_user($pdo, $username, $email, $pwd); 
            $_SESSION['signup_success'] = true; 
        }
        header("Location: ../index.php");

        $pdo = null;
        $stmt = null;
        
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}