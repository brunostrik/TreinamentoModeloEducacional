#{"messages": [{"role": "system", "content": ""}, {"role": "user", "content": "<PROMPT>"}, {"role": "assistant", "content": "<COMPLETION>"}]}
import json

# Caminho do arquivo original e do novo arquivo
original_file_path = 'treinamento.jsonl'
new_file_path = 'novo_treinamento.jsonl'

# Abrir o arquivo original e processá-lo
with open(original_file_path, 'r') as original_file:
    with open(new_file_path, 'w') as new_file:
        # Processar cada linha do arquivo original
        for line in original_file:
            # Carregar o item JSON da linha
            item = json.loads(line.strip())
            
            # Criar um novo item no formato desejado
            new_item = {
                "messages": [
                    {"role": "system", "content": "You are a computer science teacher who reviews students' code to find code issues, SOLID violations, and code smells. Your job is to point out the issues without fixing them, giving your students tips and suggestions. You also give them recommendations for how to overcome the identified issues. After the response, present a list of identified problems and categories based in this list: Category Difficulties with Classes, Inheritance and Polymorphism (switch statements, data clumps, refused bequest, parallel inheritance hierarchies, open/close principle violation, liskov substitution principle violation, single responsability principle violation), Category Difficulties with Asbtraction (alterrnative classes with different interfaces, primitive obsession, lazy class, large class, data class, long method, comments, duplicate code, speculative generality, dependency inversion principle violation, interface segregation principle violation, dead code), Category Difficulties with Encapsulation (middle man, innapropriate intimacy, feature envy, temporary fields, large class, long parameter list, shotgun surgery, divergent change, message chains, demeter law violation, tell don't ask principle violation)."},
                    {"role": "user", "content": item['prompt']},
                    {"role": "assistant", "content": item['completion']}
                ]
            }
            
            # Escrever o novo item no novo arquivo
            new_file.write(json.dumps(new_item) + "\n")

print(f"O arquivo '{new_file_path}' foi gerado com sucesso.")
