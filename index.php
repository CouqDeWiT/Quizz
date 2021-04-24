<?php
session_start();
$jsonString = file_get_contents('data.json');
$data = json_decode($jsonString, true) ?? [];
$_SESSION['data'] = $data;
$run = false;
function questChoice($index){
    $_SESSION['current']=$index;
    return ("
       <div class='Question' name = 'quest-$index'>{$_SESSION['data'][$index]['quest']}</div>
       <div class='grid-containerQuest'>
       <p id='A' name='btn-c-A' class = 'btn-c'>{$_SESSION["data"][$index]['inputA']}</p>
       <p id='B' name='btn-c-B' class = 'btn-c'>{$_SESSION["data"][$index]['inputB']}</p>
       <p id='C' name='btn-c-C' class = 'btn-c'>{$_SESSION["data"][$index]['inputC']}</p>
       <p id='D' name='btn-c-D' class = 'btn-c'>{$_SESSION["data"][$index]['inputD']}</p>

</div>
    ");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <link rel = "stylesheet" type="text/css" href = 'css/index.css'>
  <meta charset="UTF-8">
  <title>Quizz Input</title>

</head>
<body><form action="input.php" class="heading">
<h1>Question and Answer</h1>
    <button type="submit" class="nhap">Nhap</button>
</form>
<form method="post" class="grid-containerQ">
<?php
foreach ($_SESSION['data'] as $index => $datum){
    echo "<button class='Quest' name='btn-$index'>". $index+1 ."</button>";
}
?>
</form>
<form action="" method="post">
<?php
    foreach ($_SESSION['data'] as $index => $datum){
        if(isset($_POST["btn-$index"])){
            echo questChoice($index);
            $run = true;
        }
    }
if(!$run){
echo questChoice($_SESSION['current'] ?? 0);
}
foreach (range('A','D') as $key){
if(isset($_POST["btn-c-$key"])){
if(isset($_SESSION['data'][$_SESSION['current']][$key])) {
echo "<script type='text/javascript'>alert('right');</script>";
}
else echo "<script type='text/javascript'>alert('wrong');</script>";
}
}
?>
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    var checkCorrect = "<?php foreach (range('A','D') as $key){
        if(isset($_SESSION['data'][$_SESSION['current']][$key])) {
            echo $key;
        }
        }?>";
    $('#A').click(function (){check('A')});
    $('#B').click(function (){check('B')});
    $('#C').click(function (){check('C')});
    $('#D').click(function (){check('D')});
    function check(key){
        let value = '#' + key;
        if(key ==checkCorrect){
            $(value).css("background", "green");
        }
        else $(value).css("background", "red");
    }
</script>
</body>
</html>




