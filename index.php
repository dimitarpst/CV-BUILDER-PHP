<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/register_view.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includesCV/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Colo</span>ssus</div>
        </a>
        <ul class="navbar">
            <li><a href="#"><i class='bx bx-group'></i>About</a></li>
            <li><a href="#"><i class='bx bxs-contact'></i>Contacts</a></li>
        </ul>
        <div class="bx bx-menu" id="menu-icon"></div>
    </header>

    <section class="middle">
        <div class="middle-text">
            <h5>Impress with a Professional CV</h5>
            <h4>Craft a Personalized Resume in Minutes</h4>
            <h1>Create Your Perfect CV</h1>
            <p>Unlock new career opportunities with a tailored CV that highlights your skills and experience.</p>

            <div class="modal-buttons">
                <button onclick="toggleModalLogin(event)" type="button">Login</button>
                <button onclick="toggleModalRegister(event)" type="button">Register</button>
            </div>
        </div>
        <div class="modal-background" id="login-modal-background"></div>
        <div class="modal-background" id="register-modal-background"></div>

        <div class="middle-img">
            <img src="img/img.png" alt="CV Image">
        </div>
        <div class="blur-overlay"></div>
    </section>

    <div class="modal1">
        <div class="lrcard">
            <h2>Login</h2>
            <h3>Enter your credentials</h3>

            <form class="lrform login-form" action="includes/login.inc.php" method="post">
                <?php login_inputs(); ?>
                <button type="submit">Login</button>
            </form>
            <button class="close-button" onclick="closeModalLogin(event)"><i class='bx bx-x-circle'></i></button>
        </div>
    </div>

    <div class="modal2">
        <div class="lrcard">
            <h2>Sign up</h2>
            <h3>Enter your credentials</h3>
            
            <form class="lrform register-form" action="includes/register.inc.php" method="post">
                <?php
                register_inputs();
                ?>                
                <span></span>
                <button type="submit">Register</button>
            </form>
            <button class="close-button" onclick="closeModalRegister(event)"><i class='bx bx-x-circle'></i></button>
        </div>
    </div>
    <div class="modal3">
        <div class="errorcard">
            <h2 id="error-title">Error</h2>
        <div id="error-message"></div> <button class="close-button" onclick="closeModalError(event)"><i class='bx bx-x-circle'></i></button>
        </div>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/sr.js"></script>
    <script src="js/resize.js"></script>
    <script src="js/modalLR.js"></script>
    <script src="js/modalMsg.js"></script>

    <?php
    check_register_errors();
    check_login_errors();
    check_logout();
    check_login();
    checkAlreadyLoggedIn();
    user_delete_success();
    ?>
</body>

</html>

