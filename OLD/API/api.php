<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

header('Content-Type: application/json');

$client = new Client();
$apiUrl = 'https://api.openai.com/v1/chat/completions';
$apiKey = '?'; 
$model = 'ft:gpt-4o-mini-2024-07-18:personal:segunda-tentativa:A0pimeji'; //TREINADO
//$model = 'gpt-4o-mini'; //VANILLA

$host = 'localhost';
$db = 'strikcom_mestrado';
$user = 'strikcom_mestrado';
$pass = '?';

$codigo = $_POST['codigo'] ?? '';
$chave = $_POST['chave'] ?? '';

if (!$codigo || !$chave) {
    echo ('Erro: Código ou chave faltando.');
    exit;
}

// Verificação da chave no banco de dados
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo("Erro: " . $conn->connect_error);
    exit;
} 
$sql = "SELECT * FROM chaves WHERE chave = '$chave'";
$result = $conn->query($sql);

if ($result->num_rows <= 0) {
    echo ("Erro: Chave inválida.");
    exit;
}

try {
    $response = $client->post($apiUrl, [
        'headers' => [
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ],
        'json' => [
            'model' => $model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are a computer science teacher who reviews students' code to find code issues, SOLID violations, and code smells. Your job is to point out the issues without fixing them, giving your students tips and suggestions. You also give them recommendations for how to overcome the identified issues. After the response, present a list of identified problems and categories based in this list: Category Difficulties with Classes, Inheritance and Polymorphism (switch statements, data clumps, refused bequest, parallel inheritance hierarchies, open/close principle violation, liskov substitution principle violation, single responsability principle violation), Category Difficulties with Asbtraction (alterrnative classes with different interfaces, primitive obsession, lazy class, large class, data class, long method, comments, duplicate code, speculative generality, dependency inversion principle violation, interface segregation principle violation, dead code), Category Difficulties with Encapsulation (middle man, innapropriate intimacy, feature envy, temporary fields, large class, long parameter list, shotgun surgery, divergent change, message chains, demeter law violation, tell don't ask principle violation)."
                ],
                [
                    'role' => 'user',
                    'content' => $codigo
                ]
            ]
        ]
    ]);

    $body = json_decode($response->getBody(), true);
    $chatResponse = $body['choices'][0]['message']['content'] ?? '';
    $resp = htmlspecialchars($chatResponse);
    $cod = htmlspecialchars($codigo);
    $sql = "INSERT INTO requisicoes (chave, codigo, resposta) VALUES ('$chave', '$cod', '$resp')";
    //echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo ($chatResponse);
      } else {
        echo "Erro: " . $sql . " - " . $conn->error;
      }
      
      $conn->close(); 
} catch (Exception $e) {
    echo ('Erro: ' . $e->getMessage());
}
?>