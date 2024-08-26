import os
import re

def contar_palavras_em_arquivo(caminho_arquivo):
    with open(caminho_arquivo, 'r', encoding='utf-8') as f:
        texto = f.read()
        
        # Remove aspas duplas, dois pontos, chaves e colchetes
        texto_limpo = re.sub(r'[":{}\[\]]', ' ', texto)
        
        # Conta palavras
        palavras = texto_limpo.split()
        return len(palavras)

def contar_palavras_em_pasta(diretorio):
    total_palavras = 0
    
    for arquivo in os.listdir(diretorio):
        if arquivo.endswith(".jsonl"):
            caminho_arquivo = os.path.join(diretorio, arquivo)
            total_palavras += contar_palavras_em_arquivo(caminho_arquivo)
    
    return total_palavras

# Diretório atual
diretorio_atual = os.getcwd()

# Contar total de palavras
total_palavras = contar_palavras_em_pasta(diretorio_atual)
print(f'Total de palavras: {total_palavras}')
