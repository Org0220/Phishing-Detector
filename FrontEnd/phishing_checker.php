<?php include_once("include/header.php"); ?>

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