<?php include_once("include/header.php"); ?>
<?php
// getting email data from mixed_emails.json
$json = file_get_contents('data/mixed_emails.json');
$data = json_decode($json, true);

?>

<div class="container">
  <form action="/quiz.php" method="post">
    <div class="panel-group">
      <?php
      $used = array();
      for ($i = 0; $i < 25; $i++) {
        $rand = rand(0, 24);
        $email = $data[$rand];
        if (in_array($rand, $used)) {
          $i--;
          continue;
        }
        array_push($used, $rand);
        echo "<div class='panel panel-default border'>";

        echo "<p>" . $email['text'] . "</p>";

        echo '<input type="radio" class="btn-check" name="options-outlined' . $rand . '" id="true' . $rand . '" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="true' . $rand . '">True</label>';
        echo '<input type="radio" class="btn-check" name="options-outlined' . $rand . '" id="false' . $rand . '" autocomplete="off">
        <label class="btn btn-outline-danger" for="false' . $rand . '">False</label>';
        echo '</div>';
      }
      ?>
    </div>

    <input type="submit" value="Submit" class="btn btn-primary">
  </form>

</div>


<?php include_once("include/footer.php"); ?>