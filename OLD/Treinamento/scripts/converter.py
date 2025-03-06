
import os
import json

# Caminho da pasta contendo os arquivos JSON
folder_path = os.getcwd()

# Inicializar uma lista para armazenar os dados combinados
combined_data = []

# Percorrer todos os arquivos na pasta e processar os que possuem a extensão .json
for filename in os.listdir(folder_path):
    if filename.endswith('.json'):
        file_path = os.path.join(folder_path, filename)
        
        # Abrir e ler o conteúdo do arquivo JSON
        with open(file_path, 'r') as f:
            try:
                data = json.load(f)
                combined_data.extend(data)  # Adicionar os dados do arquivo à lista
            except json.JSONDecodeError:
                print(f"Erro ao decodificar {filename}, ignorando o arquivo.")

# Converter a lista combinada para o formato JSONL
jsonl_combined_data = "\n".join([json.dumps(record) for record in combined_data])

# Salvar os dados combinados em um novo arquivo JSONL
output_jsonl_file_path = 'treinamento.jsonl'
with open(output_jsonl_file_path, 'w') as f:
    f.write(jsonl_combined_data)

output_jsonl_file_path
print("Arquivo JSONL combinado salvo com sucesso em:", output_jsonl_file_path)