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
        <a href="#" class="logo">
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
                <a href="#" class="profile open-profile-modal"> <img src="img/logo.png" alt="Profile Image"> </a>
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
            <?php display_cv_list($pdo, $_SESSION['user_id']); ?>
            </div>
        </main>
    </div>

<!-- CV Information Modal -->
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
                    <fieldset>
                        <legend>CV Name</legend>
                        <label for="cvname">Enter CV name</label>
                        <input type="text" id="cvname" name="cvname">
                    </fieldset>
                    <fieldset>
                        <legend>Personal Information</legend>
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname">

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">

                        <label for="gender">Gender</label>
                        <select type="text" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>

                        <label for="age">Age</label>
                        <input type="number" id="age" name="age">

                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone">

                    </fieldset>

                    <fieldset>
                        <legend>Work Experience</legend>

                        <div>
                            <label for="job-title">Job Title</label>
                            <input type="text" id="job-title" name="job_title">

                            <label for="company">Company</label>
                            <input type="text" id="company" name="company">

                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date">

                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date">
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Education</legend>

                        <div>
                            <label for="degree">Degree</label>
                            <input type="text" id="degree-1" name="degree">

                            <label for="university">University</label>
                            <input type="text" id="university" name="university">

                            <label for="graduation-year">Graduation Year</label>
                            <input type="number" id="graduation-year" name="graduation_year">
                        </div>
                    </fieldset>

                    <button id="save-cv-btn" type="submit">Save</button>
                    
                </form>
            </section>
        </div>
    </div>
    
<!-- Profile Modal -->

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
                    
                     <h2> <?php
                     output_user_info(); 
                     ?></h2>
                    <form id="profile-form" action="includes/logout.inc.php" method="POST">
                        
                        <form action="includes/logout.inc.php" method="post">                        
                            <button class="create-cv"><i class='bx bx-log-out-circle'></i>Logout</button>
                        </form>
                    </form>
                </section>
            </div>
        </div>

    </div>

    <div class="modal3">
        <div class="errorcard">
            <h2 id="error-title">Error</h2>
        <div id="error-message"></div> <button class="close-button" onclick="closeModalError(event)"><i class='bx bx-x-circle'></i></button>
        </div>
    </div>


 <?php //check_cv_errors(); ?> 
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/modalCV.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/sr.js"></script> 
    <script src="js/modalProfile.js"></script>
    <script src="js/errorMsg.js"></script>
    <?php
    check_cv_errors();
    ?>
</body>

</html>