<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise Educacional por IA</title>
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"></script>
    <style>
        textarea {
            resize: none;
        }

        .code-area {
            width: 100%;
            height: 100vh;
            background-color: #282c34;
            color: #fff;
            font-family: 'Courier New', Courier, monospace;
            padding: 10px;
            overflow-y: scroll;
        }

        .code-area:focus {
            outline: none;

        }

        .response-container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .response {
            flex-grow: 1;
            margin-top: 10px;
            height: 200px;
            min-height: 0;
            overflow-y: scroll;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row vh-100 bg-light">
            <!-- Coluna Esquerda -->           
            <div class="col-8 p-0">
                <textarea class="code-area" placeholder="Coloque seu código-fonte aqui..." id="sourcecode" name="sourcecode"></textarea>
            </div>
            <!-- Coluna Direita -->
            <div class="col-4 bg-light p-4 d-flex flex-column">                          
                <input type="hidden" id="chave" name="chave" value="e8dd299c-1a4d-48a2-849d-4bda89b039ce" />
                <button id="analyzeButton" class="btn btn-primary mt-3" onclick="sendRequest()">Analisar Código com IA</button>               
                <div id="error" class="error-message"></div>
                <div class="response-container mt-3 flex-grow-1">
                    <div class="form-control response" id="resp" name="resp">Sua resposta vai aparecer aqui</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendRequest() {
            // Limpa a mensagem de erro anterior
            document.getElementById('error').textContent = '';

            // Obtém os valores dos campos
            const sourceCode = editor.getValue();
            const chave = document.getElementById('chave').value;
            // Verifica se os campos estão preenchidos
            if (!sourceCode) {
                document.getElementById('error').textContent = 'Adicione o Código-fonte.';
                return;
            }

            // Desabilita o botão para evitar cliques repetidos
            const analyzeButton = document.getElementById('analyzeButton');
            analyzeButton.disabled = true;

            // Prepara os dados para a requisição
            const data = new URLSearchParams();
            data.append('chave', chave);
            data.append('codigo', sourceCode);

            // Envia a requisição POST
            fetch('api.php', {
                method: 'POST',
                body: data,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
            .then(response => response.text())
            .then(result => {
                //converte o markdown
                const converter = new showdown.Converter();
                const htmlResult = converter.makeHtml(result);
                // Coloca o resultado na textarea resp
                document.getElementById('resp').innerHTML = htmlResult;
            })
            .catch(error => {
                document.getElementById('resp').innerHTML = 'Erro na requisição: ' + error;
            })
            .finally(() => {
                // Reabilita o botão após a resposta
                analyzeButton.disabled = false;
            });
        }
        var editor = CodeMirror.fromTextArea(document.getElementById("sourcecode"), {
            mode: "text/x-java",
            lineNumbers: true,
            theme: "default"
        });
        editor.setSize(null, "100vh");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
