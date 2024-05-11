<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Scam Checker</title>
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
            text-align: center;
            z-index: 1000;
            /* Ensure navbar stays on top */
            transition: background-color 0.3s ease;
            /* Smooth transition on hover */
        }

        .logo {
            font-family: 'Impact', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Use a different font */
            font-size: 24px;
            /*font-weight: bold;*/
            color: #1a237e;
            /* Dark Blue */
            margin-bottom: 10px;
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
            background-color: rgba(255, 255, 255, 0.9);
            /* White with slight transparency */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            justify-content: center;
            align-items: center;
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
        <div class="logo">ANTI-PHISHING ACADEMY</div>
        <a href="#">Home</a>
        <a href="#">Test Yourself</a>
        <a href="#">Email Verification</a>
        <a href="#">What is Phishing?</a>
    </div>

    <div class="background">
        <div class="container">
            <h1>Email Scam Checker</h1>

            <p>Paste the content of the email you received below to check if it's a scam:</p>
            <form action="/check_email.php" method="post">
                <label for="emailContent">Email Content:</label>
                <textarea id="emailContent" name="emailContent" placeholder="Paste your email here..."></textarea>
                <input type="submit" value="Check Scam">
            </form>
        </div>
    </div>

    <?php include_once("include/footer.php"); ?>