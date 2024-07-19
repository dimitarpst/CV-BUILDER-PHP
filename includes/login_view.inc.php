<?php

declare(strict_types= 1);

if (!isset($_SESSION['user_id'])) {
    $_SESSION['index_visit_count'] = 0; // Reset for users not logged in
} else {
    if (!isset($_SESSION['index_visit_count'])) {
        $_SESSION['index_visit_count'] = 1; // Initialize on first visit after login
    } else {
        $_SESSION['index_visit_count']++; // Increment on subsequent visits
    }
}

function output_user_info() 
{
    if (isset($_SESSION["user_id"])) {
        echo "You are logged in as: " . $_SESSION["user_username"];
    } else {
        echo "You are not logged in.";        
    }
}

function check_login_errors() {
    if (isset($_SESSION["errors_login"]) && !empty($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        $errorMessages = array_values($errors);

        echo '<script>
            window.addEventListener("load", function() {
                showErrorMessage(' . json_encode($errorMessages) . ');
            });
        </script>';
        unset($_SESSION["errors_login"]);
    } 
}
function check_logout() {
    if (isset($_GET["logout"]) && $_GET["logout"] === "success") {
        echo '<script>
            window.addEventListener("load", function() {
                showSuccessMessage("Successful logout!");                
            });
        </script>';
        
        header("Location: index.php");
        exit();
    }
}

function check_login() {
    if (isset($_SESSION['not_logged_in'])) {
        echo '<script>
            window.addEventListener("load", function() {
                showErrorMessage(["You need to log in to access this page."]);
                
            });
        </script>';
        unset($_SESSION['not_logged_in']);
    }
}

function checkAlreadyLoggedIn() {
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['index_visit_count'] <= 1) {
            echo '<script>
                    window.addEventListener("load", function() {
                        showSuccessMessage(["Successful login!"]);
                    });
                  </script>';
        } else {
            echo '<script>
                    window.addEventListener("load", function() {
                        showErrorMessage(["You are already logged in. Redirecting to dashboard..."]);
                        setTimeout(function() {
                            window.location.href = "dashboard.php";
                        }, 2000);
                    });
                  </script>';
        }
    }
}

function login_inputs() {
    if (isset($_SESSION['login_data']['username'])) { 
        echo '<input type="text" placeholder="Username or Email" name="username" value="' . htmlspecialchars($_SESSION['login_data']['username']) . '">';
    } else {
        echo '<input type="text" placeholder="Username or Email" name="username">';
    }

    echo '<input type="password" placeholder="Password" name="pwd">'; 
}