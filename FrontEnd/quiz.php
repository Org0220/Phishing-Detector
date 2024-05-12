<?php include_once("include/header.php"); ?>
<?php
// getting email data from mixed_emails.json
$json = file_get_contents('data/mixed_emails.json');
$data = json_decode($json, true);

?>

<div class="container">
  <?php
  if (isset($_POST['submit'])) {
    $score = 0;
    for ($i = 0; $i < 25; $i++) {
      if ($_POST['options-outlined' . $i] == "correct") {
        $score++;
      }
    }

    echo '<div class="alert alert-success" role="alert">
      Your score is: ' . $score . ' 
    </div>';
  }
  ?>
  <form action="/Phishing-Detector/FrontEnd/quiz.php" method="post">
    <div class="panel-group ">
      <?php
      $used = array();
      for ($i = 0; $i < 25; $i++) {
        $rand = rand(0, count($data) - 1);
        $email = $data[$rand];
        if (in_array($rand, $used)) {
          $i--;
          continue;
        }
        array_push($used, $rand);

        //split email text int subject and body

        $decomposedEmail = explode("\n", $email['text'], 2);
        if (count($decomposedEmail) == 1) {
          $decomposedEmail[1] = $decomposedEmail[0];
          $decomposedEmail[0] = "No Subject";
        }
        echo '<div class="panel panel-default  ">';
        echo "<h3>" . $decomposedEmail[0] . "</h3>";
        echo "<p>" . $decomposedEmail[1] . "</p>";

        if ($email['label'] == 'spam') {
          echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" id="true' . $i . '" autocomplete="off" checked>
          <label class="btn btn-outline-success" for="true' . $i . '">True</label>';
          echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" value ="correct" id="false' . $i . '" autocomplete="off" >
          <label class="btn btn-outline-danger" for="false' . $i . '">False</label>';
        } else {
          echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" value ="correct" id="true' . $i . '" autocomplete="off" checked>
          <label class="btn btn-outline-success" for="true' . $i . '">True</label>';
          echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" id="false' . $i . '" autocomplete="off">
          <label class="btn btn-outline-danger" for="false' . $i . '">False</label>';
        }

        echo '</div><br>';
      }
      ?>
    </div>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
  </form>

</div>


<?php include_once("include/footer.php"); ?>