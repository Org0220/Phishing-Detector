<?php
// getting email data from mixed_emails.json
$json = file_get_contents('data/mixed_emails.json');
$data = json_decode($json, true);

?>
<?php include_once("include/header.php"); ?>


<div class="container">
    <?php
    foreach ($data as $email) {
        echo "<div class='panel panel-default'>";
        echo "<div class='panel-body'>";
        echo "<h3>" . $email['label'] . "</h3>";
        echo "<p>" . $email['text'] . "</p>";
        echo "<button type='button' class='btn btn-primary'>Left</button>";
        echo "<button type='button' class='btn btn-primary'>Middle</button>";
        echo "<button type='button' class='btn btn-primary'>Right</button>";
        echo "</div>";
        echo "</div>";
    }
    ?>

</div>