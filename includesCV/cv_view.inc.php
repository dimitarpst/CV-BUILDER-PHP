<?php

declare(strict_types = 1);

require_once 'includesCV/cv_model.inc.php';

/*function check_cv_errors()
{
    //i need to do the errorhandling functions here
  
}*/

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
                    <select id="gender" name="gender" >
                        <option value="male" <?= $cv['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= $cv['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= $cv['gender'] == 'other' ? 'selected' : '' ?>>Other</option>
                    </select>

                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" value="<?= htmlspecialchars(strval($cv['age'])) ?>" >

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
                    <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($cv['start_date']) ?>" >

                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($cv['end_date']) ?>" >
                </fieldset>

                <fieldset>
                    <legend>Education</legend>
                    <label for="degree">Degree:</label>
                    <input type="text" id="degree" name="degree" value="<?= htmlspecialchars($cv['degree']) ?>" >

                    <label for="university">University:</label>
                    <input type="text" id="university" name="university" value="<?= htmlspecialchars($cv['university']) ?>" >

                    <label for="graduation-year">Graduation Year:</label>
                    <input type="number" id="graduation-year" name="graduation_year" value="<?= htmlspecialchars(strval($cv['graduation_year'])) ?>" >
                </fieldset>
                <button type="submit" class="save-cv-btn">Save Changes</button> 
                </div>
                
            </form>
        </div>
        <?php
    }
}
    
