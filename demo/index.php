<?php
// Logout page
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href="asset/logo.ico">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anta&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin:0px 0px 0px 0px;
        }h1{
            font-family: "Anta", sans-serif;
            font-weight: 400;
            font-style: normal;
            text-align:center;
        }
        nav a {
            text-align:right;
            text-decoration: none;
            margin-right: 10px;
            font-weight: bold;
            color: #ffffff;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        strong{
           color:#40A2E3;
        }
        p{
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 45px;
            font-style : normal;
            text-align:justify;
        }
        .center {
        text-align: center;
    }

    .center img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        height: auto;
    }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="links"> 
        <nav>    
           
                <a class="up_bt" href="sign.php">Sign Up</a>
                <a class="in_bt" href="login.php">Sign In</a>
                <a class="about_bt" href="about1.html">About Us</a>
            
        </nav>
    </div>


        <div class="container">
        <h1>Welcome to SARKARI YOJNA SATHI</h1>
        <p>SARKARI YOJNA SATHI is here to help you navigate through various government schemes and find out which ones you're eligible for. With just a few simple questions, we'll provide you with personalized recommendations tailored to your circumstances.</p>
        <div class="center">
        <img src="asset/scheme1.jpg" alt="SARKARI YOJNA SATHI Logo">
        </div>
        <h2>How It Works:</h2>
        <p><strong>Answer Questions:</strong> Begin by answering a series of questions about your current situation, such as your age, employment status, income level, and any specific needs or requirements you may have.</p>
        <p><strong>Receive Recommendations:</strong> Based on your responses, our SQL command will analyze the information and match you with the government schemes and programs that align with your eligibility criteria.</p>
        <p><strong>Explore Opportunities:</strong> Explore the recommended schemes to learn more about their benefits, eligibility requirements, and how to apply. Whether you're looking for assistance with education, healthcare, housing, or other areas, we've got you covered.</p>
        <br>
        <br>
        <h2>Why Choose Us:</h2>
        <p><strong>Accuracy:</strong> Our system is designed to provide accurate and reliable recommendations, ensuring that you don't miss out on any opportunities for government assistance.</p>
        <p><strong>Ease of Use:</strong> Our user-friendly interface makes it easy and intuitive to navigate through the process, allowing you to find the information you need quickly and efficiently.</p>
        <p><strong>Empowering Individuals:</strong> We believe in empowering individuals by equality of Information.</p>

        <br>
        <br>
        <p>Ready to get started? Click below to begin exploring government schemes!</p>
        <a href="Scheme.php" class="btn">Explore Schemes</a>
        </div>

    
   

    

</body>
</html>
