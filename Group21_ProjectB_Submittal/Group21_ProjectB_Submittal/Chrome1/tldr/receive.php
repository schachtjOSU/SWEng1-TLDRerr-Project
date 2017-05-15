<?php

$foobar = isset($_POST['text']) ? $_POST['text'] : null;


//http://stackoverflow.com/questions/4064444/returning-json-from-a-php-script
header('Content-Type: application/json');

//obviously we will echo back something more interesting when we do it for real
echo json_encode("beatles");
?>