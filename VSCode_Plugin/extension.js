const vscode = require('vscode');
const fs = require('fs');
const axios = require('axios');
const marked = require('marked');
const path = require('path');

var panel;

/**
 * @param {vscode.ExtensionContext} context
 */
function activate(context) {
	let disposable = vscode.commands.registerCommand('luxai.analyze', AnalisarCodigo);	
}

async function AnalisarCodigo(uri) {
	const filePath = uri.fsPath;
	// Ler o conteúdo do arquivo
	fs.readFile(filePath, 'utf8', async (err, data) => {
		if (err) {
			vscode.window.showErrorMessage('Erro ao ler o arquivo');
			return;
		}

		// Criar e abrir a Webview para mostrar a tela de carregamento
		panel = vscode.window.createWebviewPanel(
			'apiResponseView',
			'Analisando',
			vscode.ViewColumn.One,
			{}
		);

		// Definir o conteúdo HTML da tela de carregamento
		panel.webview.html = getWebviewContent("Analisando...", true);

		try {
			// Enviar o conteúdo do arquivo como parâmetro para a API
			const response = await axios.post('http://193.180.211.251:30000/processar-codigo-v2', {
			//const response = await axios.post('http://localhost:30000/processar-codigo', {
			codigo: data, provider: 'vscode'
			});
			const { marked } = require('marked');
			let htmlContent = await marked(response.data.resultadoFeedback); //marked.parse(response.data.resultadoFeedback);
			if(response.data.guid){
				htmlContent += '<br><br><a href="http://193.180.211.251:30000/relatorio/'+response.data.guid+'" target="_blank">Visualizar relatório completo</a>';
			}

			// Mostrar a resposta da API na Webview
			panel.webview.html = getWebviewContent(htmlContent, false);
		} catch (error) {
			vscode.window.showErrorMessage('Erro ao enviar o arquivo para a IA');
			panel.webview.html = getWebviewContent('Erro ao enviar o arquivo para a IA<br>'+error, false);
		}
	});
}

// Função para gerar o conteúdo HTML da Webview
function getWebviewContent(apiResponse, loadingMode) {
	const filePath = path.join(__dirname, 'keroseneview.html');

    // Ler o conteúdo do arquivo de forma síncrona
    try {
        var htmlContent = fs.readFileSync(filePath, 'utf8');
		htmlContent = htmlContent.replace('{{apiResponse}}', apiResponse);
		if (loadingMode) {
			htmlContent = htmlContent.replace('{{loadBar}}', 'visivel');
		}else{
			htmlContent = htmlContent.replace('{{loadBar}}', 'invisivel');
		}
        return htmlContent;
    } catch (err) {
        console.error('Erro ao ler o arquivo HTML:', err);
        return `<p>Erro ao carregar o conteúdo.</p>`;
    }
	
}
function deactivate() {}

module.exports = {
	activate,
	deactivate
}
