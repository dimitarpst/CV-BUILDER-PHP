<?php
declare(strict_types=1);
require_once 'includes/dbh.inc.php';
require_once 'cvDisplay_model.inc.php';

function display_skills_in_cv(array $cvDetails) {
    for ($i = 1; $i <= 5; $i++) {
        $yearsOfExp = htmlspecialchars(strval($cvDetails['years_of_exp' . $i]));
        $displayStyle = $yearsOfExp == "0" ? 'style="display: none;"' : '';
        echo '<div id="skill' . $i . '" class="skill" ' . $displayStyle . '>';
        echo '<div>';
        echo '<span>' . htmlspecialchars($cvDetails['skill_name' . $i]) . '</span>';
        echo '</div>';
        echo '<div class="yearsOfExperience">';
        echo '<span class="alignright">' . htmlspecialchars(strval($cvDetails['years_of_exp' . $i])) . '</span>';
        echo '<span class="alignleft">years</span>';
        echo '</div>';
        echo '</div>';
    }
}