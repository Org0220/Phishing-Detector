<?php

$myfile = fopen("currentId.txt", "w") or die("Unable to open file!");

fwrite($myfile, "");
fclose($myfile);

header("Location: http://localhost/Phishing-Detector/FrontEnd/login.php");
