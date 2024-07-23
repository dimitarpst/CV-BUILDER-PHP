<?php
 
 if (isset($_GET['cv_id'])) {
  require_once 'includes/dbh.inc.php';
  require_once 'includesCVDisplay/cvDisplay_model.inc.php';
  require_once 'includesCVDisplay/cvDisplay_contr.inc.php';

  $cvDetails = get_cv_details_by_id($pdo, (int)$_GET['cv_id']);

  if (!$cvDetails) {
    header('Location: dashboard.php');
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&family=Julius+Sans+One&family=Open+Sans&family=Source+Sans+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/cv.css">
</head>
<body>
  <page size="A4" id="page">
    <div class="container">
      <div class="leftPanel">
        <img src="img/img.png"/>
        <div class="details">

          <div class="item bottomLineSeparator">
            <h2>CONTACT</h2>
            <div class="smallText">
              <p><i class='bx bxs-phone'></i><?= htmlspecialchars($cvDetails['phone']) ?></p>
              <p><i class='bx bxs-envelope'></i><?= htmlspecialchars($cvDetails['email']) ?></p>  
            </div>
          </div>

          <div class="item bottomLineSeparator">
            <h2>Details</h2>
            <div class="smallText">
              <p><i class='bx bx-male-female'></i> <?= htmlspecialchars($cvDetails['gender']) ?></p>
              <p><i class='bx bx-time-five'></i> <?= htmlspecialchars($cvDetails['age']) ?></p>
            </div>
          </div>

          <div class="item bottomLineSeparator">
            <h2>Skills</h2>
            <div class="smallText"><?php display_skills_in_cv($cvDetails);?></div>
          </div>

          <div class="item">
            <h2>EDUCATION</h2>
            <div class="smallText">
              <p><i class='bx bxs-graduation'></i><?= htmlspecialchars($cvDetails['degree']) ?></p>
              <p><i class='bx bx-building-house'></i> <?= htmlspecialchars($cvDetails['university']) ?></p>
              <p><i class='bx bx-calendar'></i> <?= htmlspecialchars($cvDetails['graduation_year']) ?></p>
            </div>
          </div>
        </div>
        
      </div>
      <div class="rightPanel">
        <div>
          <h1><?= htmlspecialchars($cvDetails['fullname']) ?></h1>
          <div class="smallText"><h3><?= htmlspecialchars($cvDetails['job_title']) ?></h3></div>
        </div>

        <div>
          <h2>About me</h2>
          <div class="smallText"><p><?= htmlspecialchars($cvDetails['about_me'])?></p></div>
        </div>

        <div class="workExperience">
          <h2>Work experience</h2>
          <ul>
            <li>
              <div class="jobTitle">
                <span class="bolded"><?= htmlspecialchars($cvDetails['job_title']) ?></span>
                <span><?= htmlspecialchars($cvDetails['start_date']) ?> - <?= htmlspecialchars($cvDetails['end_date']) ?></span>
              </div>
              <div class="company bolded"><span><?= htmlspecialchars($cvDetails['company']) ?></span></div>
              <div class="smallText">
                <p>
                  Maecenas eget semper sapien. Sed convallis nunc egestas dui convallis dictum id nec metus. 
                  Donec vestibulum justo mauris, ac congue lacus tincidunt id. Vivamus rhoncus risus ac ex varius gravida. 
                  Donec eget ullamcorper ipsum.
                </p>
                <ul>
                  <li>
                    <p>
                      Maecenas auctor euismod felis vel semper. Nulla facilisi. 
                      Quisque quis odio dui. Morbi venenatis magna quis libero mollis facilisis. 
                      Ut semper, eros eu dictum efficitur, ligula felis aliquet ante, sed commodo odio nisi a augue. 
                    </p>
                  </li>
                  <li>
                    <p>
                      Curabitur at interdum nunc, nec sodales nulla. Nulla facilisi. 
                      Nam egestas risus sed maximus feugiat. Sed semper arcu ac dui consectetur consectetur. 
                      Nulla dignissim nec turpis id rhoncus. In hac habitasse platea dictumst. 
                    </p>
                  </li>
                  <li>
                    <p>
                      Nunc iaculis mauris nec viverra placerat. 
                      Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam erat volutpat. Vivamus sed ex et magna volutpat sodales et sed odio. 
                    </p>
                  </li>
                </ul>

              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </page>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/download.js"></script>
  
</body>
</html>