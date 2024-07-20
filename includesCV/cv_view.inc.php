<?php

declare(strict_types = 1);

require_once 'includesCV/cv_model.inc.php';

function cv_inputs() {
    echo '<fieldset>';
    echo '<legend>CV Name</legend>';
    echo '<label for="cvname">Enter CV name</label>';
    if (isset($_SESSION['cv_data']['cvname'])) {        
        echo '<input type="text" id="cvname" name="cvname" value="' . $_SESSION['cv_data']['cvname'] . '">';
    } else {
        echo '<input type="text" id="cvname" name="cvname">';
    }
    echo '</fieldset>';

    echo '<fieldset>';
    echo '<legend>Personal Information</legend>';
    echo '<label for="fullname">Full Name</label>';
    if (isset($_SESSION['cv_data']['fullname'])) {
        echo '<input type="text" id="fullname" name="fullname" value="' . $_SESSION['cv_data']['fullname'] . '">';
    } else {
        echo '<input type="text" id="fullname" name="fullname">';
    }

    echo '<label for="email">Email</label>';
    if (isset($_SESSION['cv_data']['email']) && !isset($_SESSION['errors_cv']['invalid_email'])) {
        echo '<input type="email" id="email" name="email" value="' . $_SESSION['cv_data']['email'] . '">';
    } else {
        echo '<input type="email" id="email" name="email">';
    }

    echo '<label for="gender">Gender</label>';
    echo '<select id="gender" name="gender">';
    $genderOptions = ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'];
    $selectedGender = $_SESSION['cv_data']['gender'] ?? '';
    foreach ($genderOptions as $value => $label) {
        $selected = ($value == $selectedGender) ? 'selected' : '';
        echo "<option value=\"$value\" $selected>$label</option>";
    }
    echo '</select>';

    echo '<label for="age">Age</label>';
    if (isset($_SESSION['cv_data']['age'])) {
        echo '<input type="number" id="age" name="age" value="' . $_SESSION['cv_data']['age'] . '">';
    } else {
        echo '<input type="number" id="age" name="age">';
    }
    echo '<label for="phone">Phone</label>';
    if (isset($_SESSION['cv_data']['phone'])) {
        echo '<input type="tel" id="phone" name="phone" value="' . $_SESSION['cv_data']['phone'] . '">';
    } else {
        echo '<input type="tel" id="phone" name="phone">';
    }
    echo '</fieldset>';

    echo '<fieldset>';
    echo '<legend>Work Experience</legend>';

    echo '<label for="job-title">Job Title</label>';
    if (isset($_SESSION['cv_data']['job_title'])) {
        echo '<input type="text" id="job-title" name="job_title" value="' . $_SESSION['cv_data']['job_title'] . '">';
    } else {
        echo '<input type="text" id="job-title" name="job_title">';
    }

    echo '<label for="company">Company</label>';
    if (isset($_SESSION['cv_data']['company'])) {
        echo '<input type="text" id="company" name="company" value="' . $_SESSION['cv_data']['company'] . '">';
    } else {
        echo '<input type="text" id="company" name="company">';
    }

    echo '<label for="start_date">Start Date</label>';
    if (isset($_SESSION['cv_data']['start_date'])) {
        echo '<input type="date" id="start_date" name="start_date" value="' . $_SESSION['cv_data']['start_date'] . '">';
    } else {
        echo '<input type="date" id="start_date" name="start_date">';
    }

    echo '<label for="end_date">End Date</label>';
    if (isset($_SESSION['cv_data']['end_date'])) {
        echo '<input type="date" id="end_date" name="end_date" value="' . $_SESSION['cv_data']['end_date'] . '">';
    } else {
        echo '<input type="date" id="end_date" name="end_date">';
    }
    echo '</fieldset>';

    echo '<fieldset>';
    echo '<legend>Education</legend>';
    echo '<label for="degree">Degree</label>';
    if (isset($_SESSION['cv_data']['degree'])) {
        echo '<input type="text" id="degree" name="degree" value="' . $_SESSION['cv_data']['degree'] . '">';
    } else {
        echo '<input type="text" id="degree" name="degree">';
    }
    
    echo '<label for="university">University</label>';
    if (isset($_SESSION['cv_data']['university'])) {
        echo '<input type="text" id="university" name="university" value="' . $_SESSION['cv_data']['university'] . '">';
    } else {
        echo '<input type="text" id="university" name="university">';
    }

    echo '<label for="graduation-year">Graduation Year</label>';
    if (isset($_SESSION['cv_data']['graduation_year'])) {
        echo '<input type="number" id="graduation-year" name="graduation_year" value="' . $_SESSION['cv_data']['graduation_year'] . '">';
    } else {
        echo '<input type="number" id="graduation-year" name="graduation_year">';
    }
    echo '</fieldset>';
    echo '<fieldset>';
    echo '<legend>About Me</legend>';
    echo '<label for="about_me">Describe yourself in a few sentences</label>';
    if (isset($_SESSION['cv_data']['about_me'])) {
        echo '<textarea id="about_me" name="about_me">' . $_SESSION['cv_data']['about_me'] . '</textarea>';
    } else {
        echo '<textarea id="about_me" name="about_me"></textarea>';
    }
    echo '</fieldset>';
}

function display_cv_list(object $pdo, int $user_id) {
    $cvs = get_cv_by_user_id($pdo, $user_id);
    foreach ($cvs as $cv) {
        ?>
        <div class="cv-card" data-cv-id="<?= $cv['id'] ?>">
            <form id="cv-form-<?= $cv['id'] ?>" method="POST" action="includesCV/cv_edit.inc.php">
                <input type="hidden" name="cvId" value="<?= $cv['id'] ?>">
                <h2><?= htmlspecialchars($cv['cvname']) ?></h2>
                <a href="cv.php?cv_id=<?= $cv['id'] ?>" class="view-cv-btn">View CV</a>
                <button class="delete-cv-btn" type="button">Delete CV</button>
                <button class="edit-cv-btn" type="button">Edit CV</button>
                <button class="edit-cv-btn" type="button">Download CV</button>
                <div class="cv-fields" style="display: none;"> 
                <fieldset>
                    <legend>CV Name</legend>
                    <label for="cvname">CV Name:</label>
                    <input type="text" id="cvname" name="cvname" value="<?= htmlspecialchars($cv['cvname']) ?>" >
                </fieldset>
                <fieldset>
                    <legend>Personal Information</legend>
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($cv['fullname']) ?>" >

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($cv['email']) ?>" >

                    <label for="gender">Gender:</label>
                    <select id="gender_edit" name="gender" >
                        <option value="male" <?= $cv['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= $cv['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= $cv['gender'] == 'other' ? 'selected' : '' ?>>Other</option>
                    </select>

                    <label for="age">Age:</label>
                    <input type="number" id="age_edit" name="age" value="<?= htmlspecialchars(strval($cv['age'])) ?>" >

                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars(strval($cv['phone'])) ?>" >
                </fieldset>
                
                <fieldset>
                    <legend>Work Experience</legend>
                    <label for="job-title">Job Title:</label>
                    <input type="text" id="job-title" name="job_title" value="<?= htmlspecialchars($cv['job_title']) ?>" >

                    <label for="company">Company:</label>
                    <input type="text" id="company" name="company" value="<?= htmlspecialchars($cv['company']) ?>" >

                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date_edit" name="start_date" value="<?= htmlspecialchars($cv['start_date']) ?>" >

                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date_edit" name="end_date" value="<?= htmlspecialchars($cv['end_date']) ?>" >
                </fieldset>

                <fieldset>
                    <legend>Education</legend>
                    <label for="degree">Degree:</label>
                    <input type="text" id="degree" name="degree" value="<?= htmlspecialchars($cv['degree']) ?>" >

                    <label for="university">University:</label>
                    <input type="text" id="university" name="university" value="<?= htmlspecialchars($cv['university']) ?>" >

                    <label for="graduation-year">Graduation Year:</label>
                    <input type="number" id="graduation-year_edit" name="graduation_year" value="<?= htmlspecialchars(strval($cv['graduation_year'])) ?>" >
                </fieldset>

                <fieldset>
                    <legend>About Me</legend>
                    <label for="about_me">About Me:</label>
                    <textarea id="about_me" name="about_me"><?= htmlspecialchars($cv['about_me']) ?></textarea>
                </fieldset>
                <button type="submit" class="save-cv-btn">Save Changes</button> 
                </div>
                
            </form>
        </div>

        <?php
    }
}

