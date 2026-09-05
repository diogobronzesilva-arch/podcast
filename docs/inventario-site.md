# Inventário público do Bronze Podcast

Levantamento inicial feito a partir das páginas públicas e dos resultados indexados de `bronzepodcast.com`. Serve para preservar os endereços durante a migração; deve ser revisto contra uma exportação do site antes da troca de domínio.

## Navegação principal

| Página | Endereço atual | Implementação no tema |
|---|---|---|
| Início | `/` | `front-page.php` |
| Sobre | `/sobre/` | `page-sobre.php` |
| Podcast | `/podcast/` | `page-podcast.php` |
| Blog | `/blog-list/` | Retirado do Bronze Podcast; artigos passam para as Notes de diogobronzesilva.com |
| Oração | `https://tesourofieis.com` | Ligação externa preservada |
| Loja | `/loja/` | `page-loja.php` e integração WooCommerce |
| Contacto | `/contacto/` | `page-contacto.php` |

## Plataformas e contactos

- YouTube: `https://www.youtube.com/@bronzepodcast`
- Spotify: `https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg`
- Instagram: `https://www.instagram.com/bronzepodcast/`
- X: `https://x.com/bronzpodcast`
- Email: `info@bronzepodcast.com`

## Artigos encontrados

- `/deus-e-o-belo/`
- `/a-impossibilidade-conservador-nos-costumes-e-liberal-na-economia/`
- `/rumo-ao-deserto/`

## Produtos encontrados

- `/sao-pio-x/`
- `/santa-isabel-de-portugal/`
- `/coroa-de-sao-miguel/`
- `/porta-chaves-sao-miguel-arcanjo/`
- `/terco-de-combate/`
- `/terco-da-imaculada/`
- `/medalha-de-sao-bento/`
- `/biografia-de-pio-xii-/`

## Atenção antes da migração

O site atual coloca artigos, páginas e produtos diretamente na raiz do domínio. O WordPress suporta páginas e artigos dessa forma, mas o WooCommerce usa normalmente `/product/nome-do-produto/`. Para manter os endereços de produto sem alterações, a fase da loja precisa de uma configuração de permalinks compatível e de testes de colisão de slugs.

Antes de apontar o domínio para o novo site:

1. Exportar a lista completa de URLs do construtor atual e do Google Search Console.
2. Comparar todos os URLs com o WordPress preparado.
3. Criar redirecionamentos 301 apenas para os casos em que seja impossível manter o endereço.
4. Testar catálogo, carrinho, checkout, emails, pagamentos, portes e páginas legais.
