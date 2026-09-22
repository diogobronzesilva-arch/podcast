# Roadmap e Estado Operacional do Bronze Podcast

Este documento regista o histórico de lançamento e orienta o desenvolvimento e manutenção contínua de `bronzepodcast.com`.

## Fases de Lançamento (Concluídas)

- **Fase 0 — Base do projeto [CONCLUÍDA]:** Tema personalizado WordPress/WooCommerce, tipografia institucional (Cinzel/Cormorant/Manrope) e selo numismático oficial.
- **Fase 1 — Conteúdo Editorial [CONCLUÍDA]:** Episódios estruturados com CPT nativo (`podcast_episode`) e fallback transparente; migração dos artigos antigos para as Notes de `diogobronzesilva.com`.
- **Fase 2 — Staging e Operação [CONCLUÍDA]:** Backups Hostinger, Stripe em produção com inputs dark luxury de alto contraste, notificações e emails transacionais.
- **Fase 3 — Catálogo WooCommerce [CONCLUÍDA]:** 44+ produtos categorizados, inventário ativo, cupão oficial `YOUTUBE10` e tradução completa das fichas de produto ("Peso", "Dimensões", "Avaliações").
- **Fase 4 — Legal, SEO & AEO [CONCLUÍDA]:** Termos, privacidade e envios; sitemap XML gerado pelo tema, mapa 301 para URLs históricas e framework AEO para motores de busca com IA.
- **Fase 5 — Lançamento Público [CONCLUÍDA]:** Domínio oficial ativo e loja a processar encomendas.

---

## Fase 6 — Operação Contínua & Crescimento (Ativa)

### 1. Sincronização Editorial Automática
- Registo de novos episódios do YouTube/Spotify diretamente em `wp-admin` no menu **Episódios**, sem necessidade de deploy de código.
- Atualização e padronização automática das descrições dos vídeos no YouTube com rodapé oficial e cupão `YOUTUBE10`.

### 2. Gestão de Encomendas & Portes
- Suporte aos escalões de peso CTT Expresso em Portugal e destinos internacionais europeus.
- Preservação nativa de campanhas de portes grátis ou métodos de levantamento.

### 3. Campanhas de Email Marketing
- Template oficial aprovado em `pipedrive-campaigns/campanha-bronze-podcast.html` pronto para novos episódios e lançamentos de livros/terços.
