<?php

declare(strict_types = 1);
require_once 'dbh.inc.php';
require_once 'includesCV/cv_model.inc.php';
require_once 'cv_contr.inc.php';



function cv_inputs() {
    echo '<div class="cv-fields" id="create-fields">';
    echo '<input type="hidden" id="create">';
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
        echo '<input type="text" id="university" name="university" value="'. $_SESSION['cv_data']['university'] . '">';
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
    echo '<legend>Skills</legend>';
    display_skills();
    echo '<button type="button" id="addSkillBtn">Add Skill</button>';
    echo '<button type="button" id="removeSkillBtn">Remove Skill</button>';
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
    echo '</div>';
}

function display_cv_list(object $pdo, int $user_id) {
    $cvs = get_cv_by_user_id($pdo, $user_id);
    foreach ($cvs as $cv) {
        $cvs = get_cv_by_user_id($pdo, $user_id);
        ?>
        <div class="cv-card" data-cv-id="<?= $cv['id'] ?>">
            <form id="cv-form-<?= $cv['id'] ?>" method="POST" action="includesCV/cv_edit.inc.php">
                <input type="hidden" name="cvId" value="<?= $cv['id'] ?>">
                <h2><?= htmlspecialchars($cv['cvname']) ?></h2>
                <a href="cv.php?cv_id=<?= $cv['id'] ?>" class="view-cv-btn">View CV</a>
                <button class="delete-cv-btn" type="button">Delete CV</button>
                <button class="edit-cv-btn" type="button">Edit CV</button>
                <button class="download-cv-btn" type="button">Download CV</button>
                <div class="cv-fields" id="edit-fields" style="display: none;">
                <input type="hidden" id="edit">
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
                    <legend>Skills</legend>
                    <div id="skill1" class="skill-input">
                        <label for="skill_name1">Skill 1:</label>
                        <input type="text" id="skill_name1" name="skill_name1" value="<?= htmlspecialchars($cv['skill_name1']) ?>">
                        <label for="years_of_exp1">Years of Experience:</label>
                        <input type="number" id="years_of_exp1" name="years_of_exp1" value="<?= htmlspecialchars(strval($cv['years_of_exp1'])) ?>" style="width: 45%; text-align: center;">
                    </div>
                    <div id="skill2" class="skill-input">
                        <label for="skill_name2">Skill 2:</label>
                        <input type="text" id="skill_name2" name="skill_name2" value="<?= htmlspecialchars($cv['skill_name2']) ?>">
                        <label for="years_of_exp2">Years of Experience:</label>
                        <input type="number" id="years_of_exp2" name="years_of_exp2" value="<?= htmlspecialchars(strval($cv['years_of_exp2'])) ?>" style="width: 45%; text-align: center;">
                    </div>
                    <div id="skill3" class="skill-input">
                        <label for="skill_name3">Skill 3:</label>
                        <input type="text" id="skill_name3" name="skill_name3" value="<?= htmlspecialchars($cv['skill_name3']) ?>">
                        <label for="years_of_exp3">Years of Experience:</label>
                        <input type="number" id="years_of_exp3" name="years_of_exp3" value="<?= htmlspecialchars(strval($cv['years_of_exp3'])) ?>" style="width: 45%; text-align: center;">
                    </div>
                    <div id="skill4" class="skill-input">
                        <label for="skill_name4">Skill 4:</label>
                        <input type="text" id="skill_name4" name="skill_name4" value="<?= htmlspecialchars($cv['skill_name4']) ?>">
                        <label for="years_of_exp4">Years of Experience:</label>
                        <input type="number" id="years_of_exp4" name="years_of_exp4" value="<?= htmlspecialchars(strval($cv['years_of_exp4'])) ?>" style="width: 45%; text-align: center;">
                    </div>
                    <div id="skill5" class="skill-input">
                        <label for="skill_name5">Skill 5:</label>
                        <input type="text" id="skill_name5" name="skill_name5" value="<?= htmlspecialchars($cv['skill_name5']) ?>">
                        <label for="years_of_exp5">Years of Experience:</label>
                        <input type="number" id="years_of_exp5" name="years_of_exp5" value="<?= htmlspecialchars(strval($cv['years_of_exp5'])) ?>" style="width: 45%; text-align: center;">
                    </div>
                    <button type="button" id="addSkillBtn" style="display: none;" >Add Skill</button>
                    <button type="button" id="removeSkillBtn" style="display: none;">Remove Skill</button>
                </fieldset>

                <fieldset>
                    <legend>About Me</legend>
                    <label for="about_me">Describe yourself in a few sentences:</label>
                    <textarea id="about_me" name="about_me"><?= htmlspecialchars($cv['about_me']) ?></textarea>
                </fieldset>

                <button type="submit" class="save-cv-btn">Save Changes</button>

                </div>
            </form>
        </div>

        <?php
    }
}
function display_skills() {
    if (isset($_SESSION['cv_data']['skill_name1'])) {
    for ($i = 1; $i <= 5; $i++) {
        echo '<div id="skill' . $i . '" class="skill-input">';
        echo '<label for="skill_name' . $i . '">Skill ' . $i . ':</label>';
        echo '<input type="text" id="skill_name' . $i . '" name="skill_name' . $i . '" value="' . $_SESSION['cv_data']['skill_name'. $i] . '">';
        echo '<label for="years_of_exp' . $i . '">Years of Experience:</label>';
        echo '<input type="number" id="years_of_exp' . $i . '" name="years_of_exp' . $i . '" value="' . $_SESSION['cv_data']['years_of_exp'. $i] . '" style="width: 45%; text-align: center;">';
        echo '</div>';
    }
}else{
    for ($i = 1; $i <= 5; $i++) {
        echo '<div id="skill' . $i . '" class="skill-input">';
        echo '<label for="skill_name' . $i . '">Skill ' . $i . ':</label>';
        echo '<input type="text" id="skill_name' . $i . '" name="skill_name' . $i . '" value="">';
        echo '<label for="years_of_exp' . $i . '">Years of Experience:</label>';
        echo '<input type="number" id="years_of_exp' . $i . '" name="years_of_exp' . $i . '" value="" style="width: 45%; text-align: center;">';
        echo '</div>';
    }
}
}