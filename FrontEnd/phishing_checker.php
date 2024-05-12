<?php include_once("include/header.php"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // The URL to send POST request to
    $url = 'http://127.0.0.1:5000/submit';

    // Data to send
    $postData = [
        'emailContent' => $_POST['emailContent']
    ];
    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute POST request and get the response
    $response = curl_exec($ch);
    $response = json_decode($response, true);

    // Close cURL session
    curl_close($ch);

    // Message received from Flask
    $responseMessage = $response['message'];
}
?>

<div class="background">
    <div class="container">
    <div>
        <?php
            if (!empty($responseMessage)) {
                if ($responseMessage == "Ham" )
                    echo '<div class="alert alert-success" role="alert"> This email is <strong>NOT</strong> a scam! </div>';
                else
                    echo "<div class='alert alert-danger' role='alert'> This email <strong>IS</strong> a scam! </div>";
            }
        ?>
    </div>
        <h1>Email Verification</h1>

        <p>Paste the content of the email you received below to check if it's a scam:</p>
        <form method="post">
            <label for="emailContent">Email Content:</label>
            <textarea type="text" id="emailContent" name="emailContent" placeholder="Paste your email here..."></textarea>
            <input type="submit" value="Check Scam">
        </form>
    </div>
</div>

<?php include_once("include/footer.php"); ?>