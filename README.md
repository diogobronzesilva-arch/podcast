# Bronze Podcast — tema WordPress + WooCommerce

Tema personalizado para reconstruir `bronzepodcast.com` em código, com o catálogo, carrinho e checkout geridos pelo WooCommerce e pagamentos processados pelo Stripe.

## Estado atual

- Identidade visual, logótipo e imagens principais guardados no próprio tema.
- Cabeçalho responsivo e navegação móvel.
- Página inicial com os episódios atualmente destacados e produtos recentes.
- Páginas próprias para `/sobre/`, `/podcast/`, `/blog-list/`, `/loja/` e `/contacto/`.
- Criação automática e não destrutiva das páginas e do menu ao ativar o tema.
- Formulário de contacto com validação, proteção por nonce e campo anti-spam.
- Templates de artigos, arquivo, pesquisa e erro 404.
- Integração base com WooCommerce.
- Preparado para traduções e para um tema-filho no futuro.

## Instalação

1. Criar um novo site WordPress na Hostinger.
2. Instalar e ativar WooCommerce.
3. Instalar o plugin oficial **WooCommerce Stripe Payment Gateway**.
4. Copiar `wp-content/themes/bronzepodcast` para o WordPress.
5. Ativar **Bronze Podcast** em `Aparência → Temas`.
6. Ao ativar o tema, confirmar que as páginas e o menu foram criados. O tema não substitui páginas que já existam.
7. Em `Definições → Ligações permanentes`, escolher **Nome do artigo** e guardar.
8. Em `Definições → Geral`, confirmar que o endereço de administração recebe as mensagens do formulário.

## Endereços preservados

- `/`
- `/sobre/`
- `/podcast/`
- `/blog-list/`
- `/loja/`
- `/contacto/`

O inventário completo dos endereços públicos já encontrados está em [`docs/inventario-site.md`](docs/inventario-site.md).

## Próximas etapas

- Exportar e importar os produtos, imagens e artigos do site atual.
- Configurar portes, impostos, emails e Stripe em modo de teste.
- Preservar os endereços dos produtos sem o prefixo `/product/` (requer configuração própria de ligações permanentes no WooCommerce).
- Ligar o formulário da newsletter ao serviço escolhido.
- Fazer validação visual em desktop e telemóvel.
- Preparar a transição do domínio sem interromper a loja atual.

## Estrutura

O repositório guarda apenas código e configuração versionável. Produtos, encomendas, clientes e conteúdos permanecem na base de dados WordPress e nunca devem ser enviados para o GitHub.

## Segurança

Nunca guardar no repositório `wp-config.php`, credenciais do WordPress, chaves Stripe, base de dados, encomendas ou dados de clientes. A lista de exclusões já cobre os diretórios mais comuns.
