# Bronze Podcast — tema WordPress + WooCommerce

Tema personalizado para reconstruir `bronzepodcast.com` em código, com o catálogo, carrinho e checkout geridos pelo WooCommerce e pagamentos processados pelo Stripe.

## Estado atual (Versão 1.3.1 — Pronta para Publicação em Produção)

- **Website Oficial:** Ativo e público em `bronzepodcast.com` (servidor requer upload do pacote v1.3.1).
- **Identidade e Tipografia:** Harmonização tipográfica completa com *Cinzel*, *Cormorant Garamond* e *Manrope*, com logótipo oficial otimizado em alta definição e suporte a WebP prioritário.
- **Episódios Dinâmicos:** Suporte a Custom Post Type (`podcast_episode`) com união automática e deduplicação do catálogo histórico de 13 episódios, links individuais do Spotify e diferenciação entre "Último Episódio" e "Em Destaque".
- **Loja WooCommerce:** Loja aberta com catálogo de 44+ produtos devocionais e literários, checkout integrado via Stripe Elements em dark mode e traduções completas de avaliações/atributos.
- **Portes e Envios:** Escalões por peso (CTT Expresso Portugal Continental, Açores/Madeira e Internacional) com fallback avisado de peso, preservação de transportadoras e registo de diagnósticos.
- **SEO & AEO:** Sitemap XML com inclusão de episódios e exclusão de checkout, endpoint nativo para `/llms.txt` e robots.txt configurado para motores de busca e crawlers de IA.
- **Redirecionamentos:** Mapeamento 301 estruturado para artigos históricos do blog antigo e produtos.

## Endereços preservados

- `/`
- `/sobre/`
- `/podcast/`
- `/loja/`
- `/contacto/`

O inventário completo dos endereços públicos encontra-se em [`docs/inventario-site.md`](docs/inventario-site.md).

## Publicação segura

- [`docs/release-workflow.md`](docs/release-workflow.md): fonte oficial, testes, staging, backup, publicação e rollback.
- [`docs/voz-e-copy.md`](docs/voz-e-copy.md): princípios de voz e decisões de copy para todas as páginas.
- [`docs/roadmap.md`](docs/roadmap.md): objetivos de evolução, campanhas e automação.

## Próximas etapas operacionais

- Manter o canal do YouTube sincronizado com as descrições padronizadas e o cupão oficial `YOUTUBE10`.
- Monitorização de conversão no checkout e rotinas de backup na Hostinger.
- Adicionar novos episódios diretamente no painel do WordPress através do menu Episódios.

## Estrutura

O repositório guarda apenas código e configuração versionável. Produtos, encomendas, clientes e conteúdos permanecem na base de dados WordPress e nunca devem ser enviados para o GitHub.

## Segurança

Nunca guardar no repositório `wp-config.php`, credenciais do WordPress, chaves Stripe, base de dados, encomendas ou dados de clientes. A lista de exclusões já cobre os diretórios mais comuns.
