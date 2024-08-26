<?php
require 'vendor/autoload.php';
require 'config.php';

use GuzzleHttp\Client;

header('Content-Type: application/json');

$client = new Client();
$apiUrl = 'https://api.openai.com/v1/chat/completions';
$apiKey = '?'; 
$model = 'gpt-4o-mini';

$codigo = $_POST['codigo'] ?? '';
$chave = $_POST['chave'] ?? '';

if (!$codigo || !$chave) {
    echo ('Erro: Código ou chave faltando.');
    exit;
}

// Verificação da chave no banco de dados
$stmt = $pdo->prepare("SELECT * FROM chaves WHERE chave = :chave");
$stmt->execute([':chave' => $chave]);
$chaveData = $stmt->fetch();

if (!$chaveData) {
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

    $stmt = $pdo->prepare("INSERT INTO requisicoes (chave, codigo, resposta) VALUES (:chave, :codigo, :resposta)");
    $stmt->execute([
        ':chave' => $chave,
        ':codigo' => $codigo,
        ':resposta' => $chatResponse
    ]);

    echo ($chatResponse);
} catch (Exception $e) {
    echo ('Erro: ' . $e->getMessage());
}
?>