<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Scam Checker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.3);
            /* Transparent white */
            padding: 10px 20px;
            display: flex;
            /* Use flexbox for layout */
            align-items: center;
            /* Center items vertically */
            z-index: 1000;
            /* Ensure navbar stays on top */
            transition: background-color 0.3s ease;
            /* Smooth transition on hover */
        }

        .logo {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Use a different font */
            font-size: 24px;
            font-weight: bold;
            color: #1a237e;
            /* Dark Blue */
            margin-right: auto;
            /* Pushes the logo to the left */
            display: flex;
            /* Use flexbox for layout */
            align-items: center;
            /* Center items vertically */
        }

        .logo img {
            margin-right: 10px;
            /* Add some space between logo text and image */
            max-height: 70px;
            /* Set maximum height for the image */
        }

        .navbar a {
            color: #1a237e;
            /* Dark Blue */
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            transition: color 0.3s ease;
            /* Smooth transition on hover */
        }

        .navbar a:hover {
            color: #0d47a1;
            /* Darker Blue on hover */
        }

        .container {
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.5);
            /* White with slight transparency */
            padding: 30px;
            border-radius: 10px;
            margin-top: 70px;
            /* Adjusted to make space for navbar */
        }

        .background {
            background-image: url('90614.jpg');
            /* Replace 'background-image.jpg' with the path to your background image */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .box {
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.7); /* Dark with transparency */
            padding: 30px;
            border-radius: 10px;
            margin-left: 80px;
            margin-top: 70px; /* Adjusted to make space for navbar */
            color: white; /* White text color */
        }

        .box p {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Use a different font */
            font-style: italic; /* Italic font style */
            color: #e8e9f2;
        }

        .doup {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            color: #1a237e;
            margin: 15px;
        }

        .flex-container {
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center, stretch;

        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 55%;
        }

        h1 {
            text-align: center;
            color: #1a237e;
            /* Dark Blue */
        }

        p {
            color: #555;
            line-height: 1.6;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        li {
            margin-bottom: 10px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #1a237e;
            /* Dark Blue */
        }

        textarea {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            width: 100%;
            height: 200px;
            box-sizing: border-box;
            resize: none;
        }

        input[type="submit"] {
            background-color: #1a237e;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #121858;
            /* Darker Blue on hover */
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">
            <img src="Logo.png" alt="Logo">
            Anti Phishing Academy
        </div>
        <a href="http://localhost/Phishing-Detector/FrontEnd/index.php">Home</a>
        <a href="http://localhost/Phishing-Detector/FrontEnd/quiz.php">Test Yourself</a>
        <a href="http://localhost/Phishing-Detector/FrontEnd/phishing_checker.php">Email Verification</a>
        <a href="http://localhost/Phishing-Detector/FrontEnd/educational_page.php">More on Phishing</a>
    </div>