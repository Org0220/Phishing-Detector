<?php include_once("include/header.php"); ?>

<?php
require_once 'database/db_connection.php';
require_once 'database/dml.php';
// getting email data from mixed_emails.json
$json = file_get_contents('data/mixed_emails.json');
$data = json_decode($json, true);
storeResult(25, 10);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "<script>console.log('" . $_POST['score'] . "');</script>";

  $score = $_POST['score'];
  $myfile = fopen("currentId.txt", "r") or die("Unable to open file!");
  $uid = fread($myfile, filesize("currentId.txt"));
  echo "<script>console.log('" . $uid . "');</script>";

  $uid = intval($uid);
  storeResult($uid, $score);
}
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
    border: 1px solid #1a237e;
    display: inline-block;
    color: #1a237e;
    width: 100px;
    text-align: center;
    border-radius: 3px;
    margin-top: 7px;
    text-transform: uppercase;
  }

  label.radio input:checked+span {
    border-color: #1a237e;
    background-color: #1a237e;
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

  .background {
    background-image: url('90614.jpg');
    /* Replace 'background-image.jpg' with the path to your background image */
    background-size: cover;
    background-position: center;
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
</style>


<br><br><br><br><br>
<div class="background">
  <div class="container-fluid">
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
            </div>
            <div class="d-flex flex-row align-items-center question-title">
              <h5 id="body">
                </h3>
            </div>
            <div id="ham" class="ans ml-2">
              <label class="radio"> <input type="radio" name="option" value="ham"> <span>ham</span>
              </label>
            </div>
            <div id="spam" class="ans ml-2">
              <label class="radio"> <input type="radio" name="option" value="spam"> <span>spam</span>
              </label>
            </div>


          </div>
          <div id="Next" class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">

            <button class="btn btn-primary d-flex align-items-center btn-danger" type="button" onclick=displayQuestion()>Next</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var data = <?php echo json_encode($data); ?>;
  var count = 1;
  var j = 0;
  var score = 1;
  var usedValues = [];
  var userAnswer = "";
  firstPart();
  var isQuestion = false;

  function displayQuestion() {

    if (count < 10) {
      if (isQuestion) {
        document.getElementById("spam").style.visibility = "visible";
        document.getElementById("ham").style.visibility = "visible";
        isQuestion = false;
        var radios = document.getElementsByName('option');
        if (!radios[0].checked && !radios[1].checked) {
          alert("Please select an option");
          return
        }
        if (radios[0].checked) {
          userAnswer = radios[0].value;
        } else if (radios[1].checked)
          userAnswer = radios[1].value;

        if (userAnswer == correctAnswer) {
          score++;
        }
        if (count == 9) {
          // replace with a form and submit button
          document.getElementById("Next").innerHTML = "<form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'><button class='btn btn-primary d-flex align-items-center btn-danger' type='submit' name = 'score' value = " + score + ">Next</button></form>";
        }
        count++;

        firstPart();
      } else {
        isQuestion = true;
        if (userAnswer == correctAnswer) {
          document.getElementById("subject").innerHTML = "correct";
        } else {
          document.getElementById("subject").innerHTML = "incorrect";
        }
        document.getElementById("body").innerHTML = "";
        document.getElementById("spam").style.visibility = "hidden";
        document.getElementById("ham").style.visibility = "hidden";
      }

    } else {
      alert("Quiz completed! Your score is: " + score + "/ 10");
      // // Define the URL endpoint and the data you want to send
      // const url = 'http://localhost/Phishing-Detector/FrontEnd/quiz.php';
      // const xhr = new XMLHttpRequest();
      // const data2 = {
      //   score: score
      // };
      // const jsonData = JSON.stringify(data2);

      // xhr.open('POST', url, true);
      // xhr.setRequestHeader('Content-Type', 'application/json');

      // xhr.onreadystatechange = function() {
      //   if (xhr.readyState === XMLHttpRequest.DONE) {
      //     if (xhr.status === 200) {
      //       console.log('Success:', xhr.responseText);
      //     } else {
      //       console.error('Error:', xhr.status);
      //     }
      //   }
      // };

      // xhr.send(jsonData);
      // console.log(jsonData);


    }

  }

  function firstPart() {
    j = rand(0, data.length - 1);
    while (usedValues.includes(j)) {
      j = rand(0, data.length - 1);
    }
    usedValues.push(j);
    var emailText = data[j].text;
    var email = data[j];
    var emailSubject = emailText.split("\n")[0];
    var emailBody = emailText.split("\n")[1];
    for (var i = 2; i < emailText.split("\n").length; i++) {
      emailBody += emailText.split("\n")[i];
    }
    if (emailSubject === null) {
      emailSubject = "No Subject";
    }
    if (emailBody === undefined || null) {
      emailBody = "No Body";
    }
    correctAnswer = email.label;


    document.getElementById("subject").innerHTML = emailSubject;
    document.getElementById("body").innerHTML = emailBody;

    document.getElementById("questionNumber").innerHTML = "( " + count + " of 10)";

  }

  function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }
</script>



<?php include_once("include/footer.php"); ?>