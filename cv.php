<?php
 
 if (isset($_GET['cv_id'])) {
  require_once 'includes/dbh.inc.php'; // Database connection
  require_once 'includesCVDisplay/cvDisplay_model.inc.php'; // Model function
  $host = 'localhost';
  $dbname = 'cvbuilderdb';
  $dbusername = 'root';
  $dbpassword = '';

  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
  $cvDetails = get_cv_details_by_id($pdo, (int)$_GET['cv_id']);

  if (!$cvDetails) {
    echo "CV details not found.";
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
  <style>
/* Fonts */

/* Family */

.bx {
    font-size: 1.3rem;
  }
h1 { 
    font-family: 'Julius Sans One', sans-serif;
  }
  
  h2 { /* Contact, Skills, Education, About me, Work Experience */
    font-family: 'Archivo Narrow', sans-serif;
  }
  
  h3 { /* Accountant */
    font-family: 'Open Sans', sans-serif;
  }
  
  .jobPosition span, 
  .projectName span {
    font-family: 'Source Sans Pro', sans-serif;
  }
  
  .upperCase {
    text-transform: uppercase; 
  }
  
  .smallText, 
  .smallText span, 
  .smallText p, 
  .smallText a {
    font-family: 'Source Sans Pro', sans-serif;
    text-align: justify;
  }
  
  /* End Family */
  
  /* Colors */
  h1 { 
    color: #111; 
  }
  
  .leftPanel, 
  .leftPanel a {
    color: #bebebe;
    text-decoration: none;
  }
  
  .leftPanel h2 {
    color: white;
  }
  
  /* End Colors */
  
  /* Sizes */
  h1 { 
    font-weight: 300; 
    font-size: 1.2cm;
    transform:scale(1,1.15); 
    margin-bottom: 0.2cm;
    margin-top: 0.2cm;
    text-transform: uppercase; 
  }
  
  h2 {
    margin-top: 0.1cm;
    margin-bottom: 0.1cm;
  }
  
  .leftPanel, 
  .leftPanel a {
    font-size: 0.38cm;
  }
  
  .projectName span, 
  .jobPosition span {
    font-size: 0.35cm;
  }
  
  .smallText, 
  .smallText span, 
  .smallText p, 
  .smallText a {
    font-size: 0.35cm;
  }
  
  .leftPanel .smallText, 
  .leftPanel .smallText, 
  .leftPanel .smallText span, 
  .leftPanel .smallText p, 
  .smallText a {
    font-size: 0.45cm;
  }
  
  .contactIcon {
    width: 0.5cm;
    text-align: center;
  }
  
  p {
    margin-top: 0.05cm;
    margin-bottom: 0.05cm;
  }
  /* End Sizes */
  
  .bolded {
    font-weight: bold;
  }
  
  .white {
    color: white;
  }
  /* End Fonts */
  
  /* Layout */
  body {
    background: rgb(204,204,204); 
    width: 21cm;
    height: 29.7cm;
    margin: 0 auto;
  }
  
  /* Printing */
  page {
    background: white;
    display: block;
    margin: 0 auto;
    margin-bottom: 0.5cm;
  }
  
  page[size="A4"] {  
    width: 21cm;
    height: 29.7cm; 
  }
  
  @page {
     size: 21cm 29.7cm;
     padding: 0;
     margin: 0mm;
     border: none;
     border-collapse: collapse;
  }
  /* End Printing */
  
  .container {
    display: flex;
    flex-direction: row;
    width: 100%;
    height: 100%;
  }
  
  .leftPanel {
    width: 27%;
    background-color: #484444;
    padding: 0.7cm;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .rightPanel {
    width: 73%;
    padding: 0.7cm;
  }
  
  .leftPanel img {
    width: 4cm;
    height: 4cm;
    margin-bottom: 0.7cm;
    border-radius: 50%;
    border: 0.15cm solid white;
    object-fit: cover;
    object-position: 50% 50%;
  }
  
  .leftPanel .details {
    width: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .skill {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
  
  .bottomLineSeparator {
    border-bottom: 0.05cm solid white;
  }
  
  .yearsOfExperience {
    width: 1.6cm;
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  
  .alignleft {
    text-align: left !important;
    width: 1cm;
  }
  
  .alignright {
    text-align: right !important;
    width: 0.6cm;
    margin-right: 0.1cm
  }
  
  .workExperience>ul {
    list-style-type: none;
    padding-left: 0;
  }
  
  .workExperience>ul>li {
    position: relative;
    margin: 0;
    padding-bottom: 0.5cm;
    padding-left: 0.5cm;
  }
  
  .workExperience>ul>li:before {
    background-color: #b8abab;
    width: 0.05cm;
    content: '';
    position: absolute;
    top: 0.1cm;
    bottom: -0.2cm; /* change this after border removal */
    left: 0.05cm;
  }
  
  .workExperience>ul>li::after {
    content: '';
    position: absolute;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' viewBox='0 0 32 32' focusable='false'%3E%3Ccircle stroke='none' fill='%23484444' cx='16' cy='16' r='10'%3E%3C/circle%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-size: contain;
    left: -0.09cm;
    top: 0;
    width: 0.35cm;
    height: 0.35cm;
  }
  
  .jobPosition {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
  
  .item {
    padding-bottom: 0.7cm;
    padding-top: 0.7cm;
  }
  
  .item h2{
    margin-top: 0;
  }
  
  .lastParagrafNoMarginBottom {
    margin-bottom: 0;
  }
  
  .workExperience>ul>li ul {
    padding-left: 0.5cm;
    list-style-type: disc;
  }
  /*End Layout*/

  </style>
</head>
<body>

  <page size="A4">
    <div class="container">
      <div class="leftPanel">
        <img src="img/img.png"/>
        <div class="details">
          <div class="item bottomLineSeparator">
            <h2>CONTACT</h2>
            <div class="smallText"></div>
              <p><i class='bx bxs-phone'></i><?= htmlspecialchars($cvDetails['phone']) ?></p>
              <p><i class='bx bxs-envelope'></i><a href="email"><?= htmlspecialchars($cvDetails['email']) ?></a></p>  
            </div>
          </div>
          <div class="item bottomLineSeparator">
            <h2>Details</h2>
            <div class="smallText">
              <p><i class='bx bx-male-female'></i><?= htmlspecialchars($cvDetails['gender']) ?></p>
              <p><i class='bx bx-time-five'></i><?= htmlspecialchars($cvDetails['age']) ?></p>
            </div>
          </div>
          <div class="item bottomLineSeparator">
            <h2>Skills</h2>
            <div class="smallText">
              <?php
              for ($i = 1; $i <= 5; $i++) {
                ?>
                <div class="skill">
                  <div>
                    <span><?= htmlspecialchars($cvDetails['skill_name' . $i]) ?></span>
                  </div>
                  <div class="yearsOfExperience">
                    <span class="alignright"><?= htmlspecialchars($cvDetails['years_of_exp' . $i]) ?></span>
                    <span class="alignleft">years</span>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="rightPanel">
        <div>
          <h1><?= htmlspecialchars($cvDetails['fullname']) ?></h1>
          <div class="smallText">
            <h3><?= htmlspecialchars($cvDetails['job_title']) ?></h3>
          </div>
        </div>
        <div>
          <h2>About me</h2>
          <div class="smallText">
          <p><?= htmlspecialchars($cvDetails['about_me']) ?></p>
          </div>
        </div>
        <div class="workExperience">
          <h2>Work experience</h2>
          <ul>
            <li>
              <div class="jobPosition">
                <span class="bolded"><?= htmlspecialchars($cvDetails['job_title']) ?></span>
                <span><?= htmlspecialchars($cvDetails['start_date']) ?> - <?= htmlspecialchars($cvDetails['end_date']) ?></span>
              </div>
              <div class="projectName bolded">
                <span><?= htmlspecialchars($cvDetails['company']) ?></span>
              </div>
              <div class="smallText">
                <p>Maecenas eget semper sapien. Sed convallis nunc egestas dui convallis dictum id nec metus. Donec vestibulum justo mauris, ac congue lacus tincidunt id. Vivamus rhoncus risus ac ex varius gravida. Donec eget ullamcorper ipsum.</p>
                <ul>
                  <li></li>
          <div class="item">
            <h2>
              EDUCATION
            </h2>
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
          <h1>
          <?= htmlspecialchars($cvDetails['fullname']) ?>
          </h1>
          <div class="smallText">
            <h3>
            <?= htmlspecialchars($cvDetails['job_title']) ?>
            </h3>
          </div>
        </div>
        <div>
          <h2>
            About me
          </h2>
          <div class="smallText">
            <p>
            <?= htmlspecialchars($cvDetails['about_me']) ?>
            </p>
          </div>
        </div>
        <div class="workExperience">
          <h2>
            Work experience
          </h2>
          <ul>

            <li>
              <div class="jobPosition">
                <span class="bolded">
                <?= htmlspecialchars($cvDetails['job_title']) ?>
                </span>
                <span>
                <?= htmlspecialchars($cvDetails['start_date']) ?> - <?= htmlspecialchars($cvDetails['end_date']) ?>
                </span>
              </div>
              <div class="projectName bolded">
                <span>
                <?= htmlspecialchars($cvDetails['company']) ?>
                </span>
              </div>
              <div class="smallText">
                <p>
                  Maecenas eget semper sapien. Sed convallis nunc egestas dui convallis dictum id nec metus. Donec vestibulum justo mauris, ac congue lacus tincidunt id. Vivamus rhoncus risus ac ex varius gravida. Donec eget ullamcorper ipsum.
                </p>
  
                <ul>
                  <li>
                    <p>
                      Maecenas auctor euismod felis vel semper. Nulla facilisi. Quisque quis odio dui. Morbi venenatis magna quis libero mollis facilisis. Ut semper, eros eu dictum efficitur, ligula felis aliquet ante, sed commodo odio nisi a augue. 
                    </p>
                  </li>
                  <li>
                    <p>
                      Curabitur at interdum nunc, nec sodales nulla. Nulla facilisi. Nam egestas risus sed maximus feugiat. Sed semper arcu ac dui consectetur consectetur. Nulla dignissim nec turpis id rhoncus. In hac habitasse platea dictumst. 
                    </p>
                  </li>
                  <li>
                    <p>
                      Nunc iaculis mauris nec viverra placerat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam erat volutpat. Vivamus sed ex et magna volutpat sodales et sed odio. 
                    </p>
                  </li>
                </ul>

              </div>
            </li>
                </ul>

              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </page>
  <script src="js/download.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.4/purify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
</html>