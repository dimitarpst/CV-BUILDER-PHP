<?php

declare(strict_types= 1);

function register_inputs(){        
        if (isset($_SESSION['register_data']['username']) && !isset( $_SESSION['errors_register']['username_taken'])) {
            echo'<input type="text" placeholder="Username" name="username" value="'. $_SESSION['register_data']['username'] . '">';
        } else {
            echo'<input type="text" placeholder="Username" name="username">';
        }

        if (isset( $_SESSION['register_data']['email']) && !isset( $_SESSION['errors_register']['email_used']) && !isset( $_SESSION['errors_register']['invalid_email'])) {
            echo'<input type="text" placeholder="Email" name="email" value="'. $_SESSION['register_data']['email'] . '">';
        } else {
            echo'<input type="text" placeholder="Email" name="email">';
        }

        echo '<input type="password" placeholder="Password" name="pwd">'; 
        echo '<input type="password" placeholder="Confirm Password" name="pwdrepeat" id="pwdrepeat-register">';
}

function check_register_errors()
{
    if (isset($_SESSION['errors_register'])) {
        $errors = $_SESSION['errors_register'];

        $errorMessages = array_values($errors);

        echo '<script>
            window.addEventListener("load", function() {
                showErrorMessage('.json_encode($errorMessages).');
            });
        </script>';
        unset($_SESSION['errors_register']);
    } else if (isset($_SESSION['signup_success'])) {
        echo '<script>
            window.addEventListener("load", function() {
                showSuccessMessage("Successful registration!"); 
            });
        </script>';
        unset($_SESSION['signup_success']);        
    }

}

