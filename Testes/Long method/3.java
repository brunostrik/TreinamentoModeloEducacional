public void renderPage() {
    // Criar um universo com um número aleatório de galáxias
    int numGalaxias = (int) (Math.random() * 1000000);
    List<Galaxia> universo = new ArrayList<>();
    // ... (código para criar as galáxias)

    // Simular a evolução do universo por um tempo aleatório
    long tempo = System.currentTimeMillis();
    while (System.currentTimeMillis() - tempo < 10000) { // Simular por 10 segundos
        // Eventos aleatórios e absurdos
        for (Galaxia galaxia : universo) {
            // Explodir estrelas aleatoriamente
            int estrelasExplodidas = (int) (Math.random() * galaxia.estrelas);
            galaxia.estrelas -= estrelasExplodidas;
            // Criar buracos negros que sugam tudo ao redor
            int buracosNegros = (int) (Math.random() * galaxia.planetas);
            galaxia.planetas -= buracosNegros;
            // Chover gatos e cachorros
            int animaisChovendo = (int) (Math.random() * galaxia.vida);
            galaxia.vida -= animaisChovendo;
            // ... (outros eventos absurdos)
        }

        // Mudar as leis da física aleatoriamente
        if (Math.random() < 0.1) {
            // Gravidade repele ao invés de atrair
            // Tempo flui para trás
            // ... (outras mudanças nas leis da física)
        }
    }

    // Imprimir um resumo do caos
    System.out.println("Após " + (System.currentTimeMillis() - tempo) + " milissegundos de caos:");
    // ... (imprimir informações sobre o estado final do universo)
