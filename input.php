<!DOCTYPE html>
<html lang="en">
<head>
  <link rel = "stylesheet" type="text/css" href = 'css/index.css'>
  <meta charset="UTF-8">
  <title>Quizz Input</title>

</head>
<body>
<h1>Question and Answer</h1>
<form action="" method="post">
<div class="questInput"><textarea name="quest">Question</textarea></div>
<div class="grid-container">
  <div class="item1"><textarea class="textArea" name="inputA">A</textarea><input type="checkbox" name="A"></div>
  <div class="item2"><textarea class="textArea" name="inputB">B</textarea><input type="checkbox" name="B"></div>
  <div class="item3"><textarea class="textArea" name="inputC">C</textarea><input type="checkbox" name="C"></div>
  <div class="item4"><textarea class="textArea" name="inputD">D</textarea><input type="checkbox" name="D"></div>
</div>
<button type="submit" name ="submit-Quizz" class="submit">Submit</button>
</form>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $( "input[type=checkbox]" ).on("checked", function (){
        if($("input:checked").length >= 1){
            $("input[type=checkbox]").
        }
    })
</script>
</html>


<?php
$jsonString = file_get_contents('data.json');
$data = json_decode($jsonString, true) ?? [];
$_SESSION['data']=$data;
if(isset($_POST['quest'])) {
    $obj = [];
    $check = false;
    foreach (range('A', 'D') as $char) {
        if (isset($_POST[$char])) {
            if ($check) {
                echo "<script type='text/javascript'>alert('Please check only one correct anwser');</script>";
                return;
            } else $check = true;
        }
    }
    if (!$check) {
        echo "<script type='text/javascript'>alert('Please check correct anwser');</script>";
        return;
    }
    foreach ($_POST as $key => $value) {
        $obj[$key] = $value;
    }
    unset($obj['submit-Quizz']);
    array_push($data, $obj);
    $jsonData = json_encode($data);
    file_put_contents('data.json', $jsonData);
    echo "<script type='text/javascript'>alert('Question is saved');</script>";

}

?>


