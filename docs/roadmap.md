# Roadmap de lançamento

Este documento separa o que pode ser feito já do que exige decisões, credenciais ou alterações no site público.

## Fase 0 — Base do projecto

**Estado: concluída no site temporário.**

- Tema WordPress e WooCommerce criado.
- Páginas principais publicadas; o Blog foi retirado por decisão editorial.
- Revamp visual mobile-first concluído.
- Copy 0.4.1 publicado.
- Ramo local alinhado com o GitHub e validações automáticas activas.

**Para fechar a fase:** manter o GitHub e a instalação WordPress alinhados.

## Fase 1 — Conteúdo editorial

**Objectivo:** o Podcast apresenta episódios reais; os artigos vivem nas Notes de diogobronzesilva.com.

1. Confirmar os episódios que devem estar na página inicial.
2. Publicar os artigos existentes nas Notes de diogobronzesilva.com.
3. Definir redireccionamentos para os URLs históricos quando a estrutura das Notes estiver confirmada.
4. Definir uma rotina simples: episódio no Bronze Podcast e artigo complementar nas Notes quando fizer sentido.
5. Ligar a newsletter a um serviço escolhido, apenas quando houver uma cadência editorial definida.

**Concluído quando:** a página inicial mostra episódios reais, não há conteúdo provisório no Bronze Podcast e os artigos estão nas Notes.

## Fase 2 — Staging e operação

**Objectivo:** preparar a loja sem risco para o site público.

1. Criar uma instalação de staging na Hostinger, protegida por acesso restrito.
2. Criar e confirmar um backup completo antes de cada publicação.
3. Instalar um serviço SMTP e testar a entrega do formulário de contacto.
4. Configurar a loja em modo de teste: Stripe, emails, portes e impostos.
5. Definir quem recebe emails de encomenda e de contacto.

**Concluído quando:** uma encomenda de teste chega ao fim, os emails são entregues e o rollback foi testado uma vez.

## Fase 3 — Catálogo WooCommerce

**Objectivo:** migrar a loja com informação correcta e pronta a vender.

1. Criar categorias: terços e devoções, livros e biografias, artigos religiosos.
2. Importar cada produto com nome, preço, stock, fotografias, peso, dimensões e descrição.
3. Preservar os URLs dos produtos quando possível; criar redireccionamentos 301 nos restantes.
4. Configurar portes para Portugal e restantes destinos que pretendas servir.
5. Testar produtos esgotados, cupões, reembolsos e taxas de envio.

**Concluído quando:** catálogo, carrinho, checkout, emails e stock funcionam em staging.

## Fase 4 — Legal, SEO e domínio

**Objectivo:** abrir o site sem perder tráfego nem deixar falhas básicas.

1. Criar páginas de privacidade, termos, envios e devoluções.
2. Confirmar consentimento e política da newsletter.
3. Comparar o inventário de URLs com o site actual e preparar redireccionamentos 301.
4. Ligar Search Console, sitemap e analytics que escolhas.
5. Apontar o domínio `bronzepodcast.com` apenas depois do checklist final.

**Concluído quando:** não há URLs críticos em falta, as páginas legais estão prontas e a monitorização está activa.

## Fase 5 — Lançamento

1. Fazer backup final.
2. Publicar a versão aprovada do tema.
3. Remover o modo “Coming soon”.
4. Testar em telemóvel e sem sessão iniciada.
5. Fazer uma compra real de valor reduzido e validar emails, pagamento e stock.
6. Monitorizar erros, encomendas e páginas 404 durante a primeira semana.

## Decisões que dependem de ti

- Aprovação do copy 0.4.1.
- Serviço de newsletter.
- Países de envio, preços de portes e política de devoluções.
- Dados da empresa ou pessoa vendedora para páginas legais e Stripe.
- Momento de troca para `bronzepodcast.com`.
