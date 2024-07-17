﻿<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Free Dental Medical Hospital Website Template | Smarteyeapps.com</title>

    <link rel="shortcut icon" href="img/fav.jpg">
    <link rel="stylesheet" type="text/css" href="css/cv/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/cv/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/cv/styleCV.css" />
</head>

<body>
    <div class="container-fluid overcover">
        <div class="container profile-box">
            <div class="row">
                <div class="col-md-4 left-co">
                    <div class="left-side">
                        <div class="profile-info">                            
                            <h2 id="fullname">Fullname</h2>
                            <h5>Gender</h5>
                            <h6>Age</h6>
                        </div>
                        <h4 class="ltitle">Contact</h4>
                        <div class="contact-box pb0">
                            <div class="icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="detail">
                                phone
                            </div>
                        </div>
                        <div class="contact-box pb0">
                            <div class="icon">
                                <i class="fas fa-globe-americas"></i>
                            </div>
                            <div class="detail">
                                email <br>
                            </div>
                        </div>

                        
                    </div>
                </div>
                <div class="col-md-8 rt-div">

                        <h2 class="rit-titl"><i class="fas fa-briefcase"></i> Work Experiance</h2>
                        <div class="work-exp">
                            <ul>
                                <li><i class="far fa-hand-point-right"></i> Job Title </li>
                                <li><i class="far fa-hand-point-right"></i> Company </li>
                                <li><i class="far fa-hand-point-right"></i> Start Date </li>
                                <li><i class="far fa-hand-point-right"></i> End Date </li>
                            </ul>
                        </div>

                        <h2 class="rit-titl"><i class="fas fa-graduation-cap"></i> Education</h2>
                        <div class="education">
                            <ul class="row no-margin">
                                <li class="col-md-6">
                                    Degree</li>
                                <li class="col-md-6">
                                    University</li>
                                <li class="col-md-6">
                                    Graduation Year</li>
                                
                            </ul>
                        </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/js/cvstuff/jquery-3.2.1.min.js"></script>
<script src="/js/cvstuff/popper.min.js"></script>
<script src="/js/cvstuff/bootstrap.min.js"></script>
<script src="/js/cvstuff/script.js"></script>
<script>// Update the template with actual CV information
window.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch('/api/cv', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + sessionStorage.getItem('token')
            },
        });

        if (response.ok) {
            const cvData = await response.json();

            // Populate the template with CV information
            document.getElementById('fullname').textContent = cvData.FullName;
            document.getElementById('gender').textContent = cvData.Gender;
            document.getElementById('age').textContent = cvData.Age;
            document.getElementById('phone').textContent = cvData.Phone;
            document.getElementById('email').textContent = cvData.Email;
            document.getElementById('job-title').textContent = cvData.Jobtitle;
            document.getElementById('company').textContent = cvData.Company;
            document.getElementById('start-date').textContent = cvData.StartDate;
            document.getElementById('end-date').textContent = cvData.EndDate;
            document.getElementById('degree').textContent = cvData.Degree;
            document.getElementById('university').textContent = cvData.University;
            document.getElementById('graduation-year').textContent = cvData.GraduationYear;
        } else {
            console.error('Failed to fetch CV data:', response.status);
        }
    } catch (error) {
        console.error('Error fetching CV data:', error);
    }
});</script>

</html>