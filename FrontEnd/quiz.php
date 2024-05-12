<?php include_once("include/header.php"); ?>
<?php
// getting email data from mixed_emails.json
$json = file_get_contents('data/mixed_emails.json');
$data = json_decode($json, true);

?>

<style>
  label.radio {
    cursor: pointer;
  }

  label.radio input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none;
  }

  label.radio span {
    padding: 4px 0px;
    border: 1px solid red;
    display: inline-block;
    color: red;
    width: 100px;
    text-align: center;
    border-radius: 3px;
    margin-top: 7px;
    text-transform: uppercase;
  }

  label.radio input:checked+span {
    border-color: red;
    background-color: red;
    color: #fff;
  }

  .ans {
    margin-left: 36px !important;
  }

  .btn:focus {
    outline: 0 !important;
    box-shadow: none !important;
  }

  .btn:active {
    outline: 0 !important;
    box-shadow: none !important;
  }
</style>

<script>
  var data = <?php echo json_encode($data); ?>;
  var count = 0;
  var j = 0;
  var score = 0;
  var usedValues = [];
  console.log(data[0]);

  function displayQuestion() {
    console.log(this.index);
    if (this.count < 10) {
      this.j = rand(0, this.data.length - 1);
      while (usedValues.includes(j)) {
        this.j = rand(0, this.data.length - 1);
      }
      usedValues.push(j);
      var emailText = this.data[j].text;
      var email = this.data[j];
      console.log(email);
      var emailSubject = emailText.split("\n")[0];
      var emailBody = emailText.split("\n")[1];
      if (emailSubject == "") {
        emailSubject = "No Subject";
      }
      if (emailBody == "") {
        emailBody = "No Body";
      }
      correctAnswer = email.label;

      total++;
      document.getElementById("subject").innerHTML = emailSubject;
      document.getElementById("body").innerHTML = emailBody;
      document.getElementById("questionNumber").innerHTML = "( " + (i + 1) + " of 10)";
      var radios = document.getElementsByName('option');


      for (var i = 0; i < radios.length; i++) {
        if (radios[this.index].checked) {
          userAnswer = radios[this.index].value;
          userAnswerIndex = options.indexOf(userAnswer);
        }
      }
      if (userAnswer == "") {
        alert("Please select an option");
        return;
      }
      checkAnswer();

      i++;
    } else {

      alert("Quiz completed! Your score is: " + score + "/ 10");
    }
  }

  function checkAnswer() {
    if (userAnswerIndex == correctAnswerIndex) {
      score++;
    }
    i++;
  }
  displayQuestion();
</script>

<div class="container ">
  <div class="d-flex justify-content-center row">
    <div class="col-md-10 col-lg-10">
      <div class="border">
        <div class="question bg-white p-3 border-bottom">
          <div class="d-flex flex-row justify-content-between align-items-center mcq">
            <h4>MCQ Quiz</h4><span id="questionNumber">( 1 of 10)</span>
          </div>
        </div>
        <div class="question bg-white p-3 border-bottom">
          <div class="d-flex flex-row align-items-center question-title">
            <h3 id="subject"></h3>

            <h5 id="body" class="mt-1 ml-2"></h5>
          </div>
          <div class="ans ml-2">
            <label class="radio"> <input type="radio" name="option" value="spam"> <span>spam</span>
            </label>
          </div>
          <div class="ans ml-2">
            <label class="radio"> <input type="radio" name="option" value="ham"> <span>ham</span>
            </label>
          </div>

        </div>
        <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
          <button class="btn btn-primary d-flex align-items-center btn-danger" type="button" onclick=displayQuestion()>Next</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <div class="container">
  <?php
  // if (isset($_POST['submit'])) {
  //   $score = 0;
  //   for ($i = 0; $i < 25; $i++) {
  //     if ($_POST['options-outlined' . $i] == "correct") {
  //       $score++;
  //     }
  //   }

  //   echo '<div class="alert alert-success" role="alert">
  //     Your score is: ' . $score . '/25 
  //   </div>';
  // }
  ?>
  <form action="/Phishing-Detector/FrontEnd/quiz.php" method="post">
    <div class="panel-group ">
      <?php
      // $used = array();
      // for ($i = 0; $i < 25; $i++) {
      //   $rand = rand(0, count($data) - 1);
      //   $email = $data[$rand];
      //   if (in_array($rand, $used)) {
      //     $i--;
      //     continue;
      //   }
      //   array_push($used, $rand);

      //   //split email text int subject and body

      //   $decomposedEmail = explode("\n", $email['text'], 2);
      //   if (count($decomposedEmail) == 1) {
      //     $decomposedEmail[1] = $decomposedEmail[0];
      //     $decomposedEmail[0] = "No Subject";
      //   }
      //   echo '<div class="panel panel-default  ">';
      //   echo "<h3>" . $decomposedEmail[0] . "</h3>";
      //   echo "<p>" . $decomposedEmail[1] . "</p>";

      //   if ($email['label'] == 'spam') {
      //     echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" id="true' . $i . '" autocomplete="off" required>
      //     <label class="btn btn-outline-success" for="true' . $i . '">True</label>';
      //     echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" value ="correct" id="false' . $i . '" autocomplete="off" required>
      //     <label class="btn btn-outline-danger" for="false' . $i . '">False</label>';
      //   } else {
      //     echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" value ="correct" id="true' . $i . '" autocomplete="off" required >
      //     <label class="btn btn-outline-success" for="true' . $i . '">True</label>';
      //     echo '<input type="radio" class="btn-check" name="options-outlined' . $i . '" id="false' . $i . '" autocomplete="off" required>
      //     <label class="btn btn-outline-danger" for="false' . $i . '">False</label>';
      //   }

      //   echo '</div><br>';
      // }
      ?>
    </div>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
  </form>

</div> -->


<?php include_once("include/footer.php"); ?>