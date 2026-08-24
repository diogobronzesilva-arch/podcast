# Workflow de publicação do Bronze Podcast

Este processo evita que o WordPress publicado, o computador local e o GitHub voltem a ficar com histórias diferentes.

## Fonte oficial

- O ramo `main` do GitHub é a fonte oficial das versões publicadas.
- Todo o trabalho começa num ramo `feature/*` e entra em `main` através de Pull Request.
- O site público nunca deve receber ficheiros que não estejam num commit identificado.
- Cada versão publicada recebe uma tag, por exemplo `v0.4.0`.

## Antes de integrar um Pull Request

1. Confirmar que o ramo local acompanha o ramo remoto com o mesmo nome.
2. Rever o diff e garantir que não existem credenciais, dados de clientes, uploads ou backups.
3. Exigir a conclusão dos testes automáticos.
4. Rever visualmente Início, Sobre, Podcast, Blog, Loja e Contacto em desktop e mobile.
5. Confirmar que a alteração ainda não depende de conteúdo ou configuração inexistente no WordPress.

## O que os testes automáticos devem garantir

- Sintaxe PHP nas versões 8.1, 8.2 e 8.3.
- Sintaxe JavaScript.
- Validade de `theme.json`.
- Igualdade entre a versão declarada no CSS e no PHP.
- Existência dos ficheiros obrigatórios.
- Criação e integridade do ZIP instalável.

## Staging

Antes da loja aceitar pagamentos, deve existir uma cópia de staging protegida por palavra-passe ou acesso restrito. O staging deve usar uma cópia sanitizada da base de dados, nunca enviar emails reais e usar Stripe em modo de teste.

No staging devem ser testados:

- navegação, formulários e links;
- produto simples e produto esgotado;
- carrinho e cupões;
- portes e impostos;
- checkout completo em modo de teste;
- emails de encomenda e recuperação de password;
- conta do cliente, política de privacidade e termos;
- comportamento mobile e acessibilidade básica.

## Publicação

1. Criar um backup completo na Hostinger, incluindo ficheiros e base de dados.
2. Guardar o ZIP da versão actualmente publicada.
3. Descarregar o artefacto produzido pelo GitHub Actions para o commit aprovado.
4. Instalar o ZIP no WordPress e substituir o tema apenas depois de confirmar a versão.
5. Limpar a cache apenas se a nova versão não aparecer.
6. Fazer um smoke test sem sessão iniciada e, depois, em mobile.
7. Criar a tag da versão publicada no GitHub.

## Rollback

Se a publicação falhar, reinstalar imediatamente o ZIP anterior. Se o problema envolver conteúdo, configuração, encomendas ou base de dados, usar o backup da Hostinger. Nunca apagar manualmente dados da loja para tentar recuperar uma publicação.

## Regras para a loja

- Nenhuma chave Stripe entra no GitHub.
- Pagamentos reais só são activados depois de um checkout completo em modo de teste.
- Produtos, encomendas, clientes e conteúdos pertencem à base de dados WordPress, não ao tema.
- A mudança do domínio exige inventário de URLs, teste de colisões e redireccionamentos 301 verificados.
