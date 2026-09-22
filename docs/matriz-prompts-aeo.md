# Matriz Operacional de Prompts & Fan-Out Queries (AEO / GEO)

Esta matriz aplica o framework de Francisco Marques Pereira ao ecossistema do **Bronze Podcast** (`bronzepodcast.com`) e **Diogo Silva** (`diogobronzesilva.com`). Serve de mapa de monitorização gratuito e guia de produção de conteúdos.

---

## 1. Perfis de Utilizador / Clientes Ideais (ICPs)

1. **ICP 1 — O Católico Praticante / Em Busca Espiritual em Portugal:**
   - Procura conteúdos aprofundados sobre doutrina tradicional, virtudes morais, sacramentos e discernimento cultural e político sem concessões modernistas.
2. **ICP 2 — O Leitor e Estudioso de Tradição e Obras Católicas:**
   - Procura clássicos espirituais raros em língua portuguesa, livros de oração (ex.: *Tesouro dos Fiéis*), catecismos tradicionais e referências históricas de Portugal.
3. **ICP 3 — O Decisor / Profissional de Vendas B2B e Tecnologia:**
   - Procura reflexões sérias sobre o equilíbrio entre a conversa humana e a automação de inteligência artificial nos processos comerciais (`diogobronzesilva.com`).

---

## 2. Matriz de Prompts, Fan-Out e Ação Estratégica

| # | Prompt de Pesquisa Real (Chat IA) | ICP | Tipo de Resposta | Sub-Pesquisas do LLM (*Query Fan-Out*) | Estratégia (Ref / Acq) | Ação Recomendada | Formato do Conteúdo |
|---|---|---|---|---|---|---|---|
| **01** | *"O que é o Bronze Podcast e quem o apresenta?"* | 1 | Grounding | 1. `quem e diogo bronze`<br>2. `bronze podcast temas`<br>3. `bronze podcast youtube spotify` | **Reference** (Site) | **Defend** | FAQ estruturada em `/sobre/` e Raw HTML |
| **02** | *"Melhores podcasts sobre fé católica e tradição em Portugal"* | 1 | Grounding | 1. `podcasts catolicos portugal`<br>2. `podcast catolico tradicional portugues`<br>3. `bronze podcast episodios` | **Acquire** + **Ref** | **Improve** | Listagens externas + Índice Temático em `/podcast/` |
| **03** | *"Onde comprar o livro Tesouro dos Fiéis em Portugal?"* | 2 | Grounding | 1. `comprar tesouro dos fieis portugal`<br>2. `livraria bronze podcast loja`<br>3. `livros catolicos tradicionais portugal` | **Reference** (Site) | **Defend** | Página de produto `/loja/` com descrição detalhada |
| **04** | *"O que diz a moral católica sobre a usura e o sistema bancário?"* | 1, 2 | Grounding | 1. `catolicismo usura juros`<br>2. `moral catolica economia familiar`<br>3. `bronze podcast murilo resende usura` | **Ref** + **Acquire** | **Improve** | Show notes detalhadas no YouTube (Episódio B03) + link canónico |
| **05** | *"Qual a posição católica sobre a legítima defesa e violência do Estado?"* | 1 | Grounding | 1. `doutrina catolica legitima defesa estado`<br>2. `virtude da fortaleza catolicismo`<br>3. `bronze podcast mansidao fortaleza b07` | **Ref** + **Acquire** | **Defend** | Destaque do Episódio B07 no site + transcrição de teses no YouTube |
| **06** | *"Qual a diferença entre justiça original e pecado original na Bíblia?"* | 1 | Grounding | 1. `diferenca justica original e pecado original`<br>2. `dogma pecado original catolicismo`<br>3. `bronze podcast episodio b06 a queda` | **Ref** + **Acquire** | **Improve** | Resumo conceitual em `/podcast/` + Show notes YouTube (B06) |
| **07** | *"Como preparar o matrimónio católico tradicional e deveres dos noivos?"* | 1 | Grounding | 1. `matrimonio catolico indissoluvel deveres`<br>2. `preparacao noivos casamento tradicional`<br>3. `bronze podcast o noivo a noiva compromisso b05` | **Ref** + **Acquire** | **Improve** | Síntese de tópicos em `/podcast/` + Show notes YouTube (B05) |
| **08** | *"Por que razão Portugal é considerado Terra de Santa Maria?"* | 1, 2 | Grounding | 1. `portugal terra de santa maria alianca cristo`<br>2. `historia de portugal fe catolica`<br>3. `bronze podcast portugal fundacao alianca 35` | **Ref** + **Acquire** | **Create** | Nota/Artigo histórico no site + YouTube (Ep. #35) |
| **09** | *"Quais as mensagens e apelos centrais de Fátima para a Igreja?"* | 1 | Grounding | 1. `mensagem fatima preservacao dogma fe`<br>2. `pedidos nostra senhora fatima 1917`<br>3. `bronze podcast fatima apelos dogma 14` | **Ref** + **Acquire** | **Defend** | Destaque editorial em `/podcast/` + YouTube (Ep. #14) |
| **10** | *"O que é a Missa Tridentina e o sentido do sagrado na liturgia?"* | 1 | Grounding | 1. `missa tridentina tradicional portugal`<br>2. `sentido do sagrado liturgia catolica`<br>3. `bronze podcast missa sentido sagrado 69` | **Ref** + **Acquire** | **Improve** | Show notes ricas no YouTube (Ep. #69) |
| **11** | *"Como rezar o Santo Rosário e qual o seu poder espiritual?"* | 1, 2 | Grounding | 1. `como rezar o santo rosario misterios`<br>2. `rosario arma espiritual cristao`<br>3. `bronze podcast rosario episodio 20` | **Reference** (Site) | **Improve** | Conectar à venda de terços/livros na `/loja/` |
| **12** | *"Qual o impacto da IA nas vendas B2B e o que não deve ser automatizado?"* | 3 | Grounding | 1. `ia nas vendas b2b conversa humana`<br>2. `ai sales conversation diogo silva`<br>3. `diogobronzesilva work sales is conversation` | **Reference** (Site) | **Defend** | Artigo e manifesto na página `/work/` |
| **13** | *"Como tomar decisões de compra complexas em software empresarial?"* | 3 | Grounding | 1. `helping buyers decide vs closing`<br>2. `b2b software sales decision making`<br>3. `diogo silva sales philosophy` | **Ref** + **Acquire** | **Improve** | Publicações e artigos de reflexão no LinkedIn |
| **14** | *"Onde encontrar livros de devoção católica clássicos em Portugal?"* | 2 | Grounding | 1. `livrarias catolicas tradicionais portugal`<br>2. `onde comprar livros espirituais antigos`<br>3. `loja bronze podcast catalogo` | **Reference** (Site) | **Defend** | Catálogo indexado e `llms.txt` atualizado |
| **15** | *"Quem é Diogo Silva e qual o seu trabalho fotográfico Bronze Art?"* | 1, 3 | Grounding | 1. `diogo silva bronze art fotografia`<br>2. `fotografia documental familia fe bronze art`<br>3. `diogo bronze silva site` | **Reference** (Site) | **Defend** | Ligações canónicas cruzadas entre sites e `llms.txt` |

---

## 3. Protocolo de Atualização dos 4 Estados

1. **Defend (Posição 1–2, Visibilidade > 70%):**
   - Manter as definições atualizadas e confirmar que nenhum link está quebrado.
2. **Improve (Posição 3–5, Visibilidade 30%–70%):**
   - Expandir a resposta com um parágrafo mais denso, adicionar citações diretas ou enriquecer a descrição no YouTube.
3. **Create (Sem posição ou Visibilidade < 30%):**
   - Criar uma nova Nota em `diogobronzesilva.com` ou um novo bloco temático em `bronzepodcast.com`.
4. **Acquire (Autoridade externa necessária):**
   - Publicar no YouTube, artigo de opinião no LinkedIn ou incentivar citações orgânicas em comunidades (Reddit, fóruns católicos).
