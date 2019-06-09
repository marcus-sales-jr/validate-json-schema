<?php
require("./vendor/autoload.php");

use JsonSchema\Validator;

$composer = file_get_contents('destaques.json');
$composerJson  = json_decode($composer);

$composerSchema = file_get_contents('destaques-schema.json');
$composerSchemaJson  = json_decode($composerSchema);

$validator = new Validator();
$validator->validate($composerJson,  $composerSchemaJson);

if($validator->isValid()){
    echo "Schema valido!";
}else{
    echo "O documento é inválido. Violações: <br>";
    echo "<ul>";
    foreach ($validator->getErrors() as $error) {
        echo "<li>" . sprintf("[%s] %s\n", $error['property'], $error['message']) . "</li>";
    }
    echo "</ul>";
}
