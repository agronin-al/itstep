<?php
if(isset($_POST["text"])){
    echo json_encode([
        "text" => $_POST['text'],
        'number' => rand(0 , 10)
    ]);
}