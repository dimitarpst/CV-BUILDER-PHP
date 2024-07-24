<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includesCV/cv_model.inc.php';
require_once 'includesCV/cv_view.inc.php';
require_once 'includesCV/cv_contr.inc.php';
require_once 'includesCV/dbh.inc.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['not_logged_in'] = true;
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <div class="blur-overlay"></div>

    <div class="sidebar">
        <a href="index.php" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Colo</span>ssus</div>
        </a>
        <ul class="side-menu">
            <li class="link-1"><a href="#"><i class='bx bx-group'></i>About</a></li>
            <li class="link-2"><a href="#"><i class='bx bxs-contact'></i>Contacts</a></li>
        </ul>
    </div>

    <div class="content">
        <nav>
            <div class="iconM">
                <i class='bx bx-menu'></i>
            </div>
            <div class="iconL">
                <a class="profile open-profile-modal"> <img src="img/logo.png" alt="Profile Image"> </a>
            </div>            
        </nav>

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
                <button class="create-cv">Create CV</button>
            </div>


            <div class="cv-list">
            <?php display_cv_list($pdo, $_SESSION['user_id']); ?></div>
        </main>
    </div>

    <div id="cv-modal-container">
        <div class="cv-modal-content">
            <div class="cv-modal-header">
                <div class="cv-modal-title">
                    <h1>Create CV</h1>
                </div>
                <div class="cv-modal-close">
                    <span id="close-cv-modal">
                        <i class='bx bx-x-circle'></i>
                    </span>
                </div>
            </div>
            <section>
                <form id="cv-form" action="includesCV/cv_create.inc.php" method="POST">
                    <?php cv_inputs(); ?>
                    <button id="save-cv-btn" type="submit">Save</button>
                    
                </form>
            </section>
        </div>
    </div>
    <div id="profile-modal-container">
        <div class="profile-modal-content">
            <div class="profile-modal-header">
                <div class="cv-modal-title">
                    <h1>View Profile</h1>
                </div>
                <div class="profile-modal-close">
                    <span id="close-profile-modal">
                        <i class='bx bx-x-circle'></i>
                    </span>
                </div>
            </div>

            <section>
                <h2>
                    <?php output_user_info();?>
                </h2>
                <form id="profile-form" action="includes/logout.inc.php" method="POST">

                    <form action="includes/logout.inc.php" method="post">
                        <button id="profileBtn"><i class='bx bx-log-out-circle'></i>Logout</button>
                    </form>
                    <form action="includes/delete_user.inc.php" method="post">
                        <button id="profileBtn"><i class='bx bx-user'></i>Delete user</button>
                    </form>
                </form>
            </section>
        </div>
    </div>

    </div>

    <div class="modal3">
        <div class="errorcard">
        <h2 id="error-title">Error</h2>
        <div id="error-message"> </div> 
        <button class="close-button" onclick="closeModalError(event)"><i class='bx bx-x-circle'></i></button>
        </div>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/modalCV.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/sr.js"></script> 
    <script src="js/modalProfile.js"></script>
    <script src="js/modalMsg.js"></script>
    <script src="js/download.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php
    check_cv_errors();
    cv_edit_success();
    cv_create_success();
    cv_delete_success();
    ?>
</body>

</html>