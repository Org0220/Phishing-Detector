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



<div class="container">
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
<script>
  var data = <?php echo json_encode($data); ?>;
  var count = 1;
  var j = 0;
  var score = 1;
  var usedValues = [];
  var userAnswer = "";
  firstPart();


  function displayQuestion() {
    console.log(count < 10)
    if (count < 10) {

      var radios = document.getElementsByName('option');
      console.log(radios)
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
      count++;

      firstPart();

    } else {
      alert("Quiz completed! Your score is: " + score + "/ 10");
      // Define the URL endpoint and the data you want to send
      const url = 'https://localhost/';
      const data = {
        key1: 'value1',
        key2: 'value2'
      };

      // Define options for the fetch request
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json' // Set the content type to JSON
        },
        body: JSON.stringify(data) // Convert the data to JSON format
      };

      // Send the POST request
      fetch(url, options)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json(); // Parse the JSON response
        })
        .then(data => {
          console.log('Success:', data);
        })
        .catch(error => {
          console.error('Error:', error);
        });


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