# Framework Prático de AEO / GEO para o Ecossistema Bronze

Este documento adapta e operacionaliza a metodologia de **Answer Engine Optimization (AEO)** e **Generative Engine Optimization (GEO)** apresentada por Francisco Marques Pereira no artigo *"How to Rank in LLMs: A Practical Framework for AEO / GEO"*, aplicando-a diretamente a **bronzepodcast.com** e **diogobronzesilva.com**.

---

## 1. Como os Modelos de Linguagem (LLMs) Funcionam e Decidem Citações

1. **Memória Paramétrica vs. Grounding (Pesquisa em Tempo Real):**
   - **Memória:** Respostas que o modelo gera puramente com base no treino histórico. Não é possível influenciá-las diretamente a curto prazo.
   - **Grounding:** Quando o utilizador faz uma pergunta factual, recente ou de nicho, o modelo executa pesquisas na web em segundo plano para recolher fontes e construir a resposta. **É apenas aqui que o AEO/GEO atua.**
   - *Regra:* Filtrar e priorizar apenas prompts que despoletem grounding.

2. **Query Fan-Out (Sub-perguntas simultâneas):**
   - Quando um LLM faz grounding, ele decompõe o prompt inicial em 3 a 10 sub-pesquisas paralelas (*fan-out queries*).
   - *Exemplo:* Perante o prompt *"Quem é o Diogo Bronze e de que fala o seu podcast?"*, o modelo divide internamente em:
     - `Quem é Diogo Bronze`
     - `Bronze Podcast temas convidados`
     - `Bronze Podcast youtube spotify`
     - `Diogo Silva Bronze Art`
   - O conteúdo do website deve fornecer respostas diretas e inequívocas a cada uma destas ramificações.

3. **Visibilidade Estrita em Raw HTML:**
   - A esmagadora maioria dos crawlers de IA (GPTBot, Claude-SearchBot, PerplexityBot) **não executa JavaScript**.
   - Apenas o código HTML puro enviado pelo servidor ("view source") é lido e tokenizado. Se títulos, resumos ou ligações dependerem de hidratação no cliente, o bot não os vê.

4. **Fontes de Alta Autoridade (UGC e Terceiros):**
   - Os LLMs têm um forte viés para citar fontes consolidadas: **YouTube, Reddit, LinkedIn, Wikipedia e imprensa especializada**.
   - O trabalho de citação reparte-se entre o próprio site (*reference*) e as presenças externas (*acquire*).

---

## 2. O Framework das 3 Perguntas (Decisão e Execução)

Para qualquer tema ou prompt de pesquisa relevante, seguir o fluxo de decisão:

### Pergunta 1: Precisamos de "possuir" este prompt?
- **É nuclear ao nosso propósito/negócio?**
  - Se sim (ex.: Fé Católica tradicional em Portugal, livros de piedade/Tesouro dos Fiéis, reflexão cultural, vendas B2B e IA): **Avançar obrigatoriamente**.
  - Se a concorrência já é citada: Sinal claro de oportunidade a recuperar.
  - Se ninguém é citado: Oportunidade de pioneirismo.
- **Não é nuclear?** Ignorar para concentrar recursos onde há retorno real.

### Pergunta 2: Referenciar (Reference) ou Adquirir (Acquire)?
- **Referenciar (No nosso site):** Quando temos autoridade direta para responder (páginas editoriais, sobre, arquivo de episódios, loja).
- **Adquirir (Fora do site):** Quando a resposta exige autoridade externa, neutralidade ou plataforma UGC.
  - **YouTube:** O YouTube é a fonte mais citada por modelos para formatos multimédia. Cada episódio deve conter descrição detalhada, timestamps temáticos e resumo factual em texto.
  - **LinkedIn:** Artigos e publicações técnicas com teses estruturadas.
  - **Reddit / Fóruns:** Participações e discussões orgânicas onde o podcast ou os artigos sejam citados por terceiros.

### Pergunta 3: Qual o tipo de intervenção e plano de ação?
Avaliar a posição (ranking entre as fontes citadas) e a visibilidade (% de chats onde somos citados):

| Estado | Posição | Visibilidade | Ação Concreta |
| :--- | :--- | :--- | :--- |
| **Defend** | 1 a 2 | > 70% | Manter atualizado, consolidar dados factuais e monitorizar. |
| **Improve** | 3 a 5 | 30% a 70% | Adicionar blocos de FAQ, tabelas de síntese, respostas diretas a sub-perguntas (*fan-out*). |
| **Create** | Nenhuma | < 30% | Criar nova página ou nota dedicada respondendo exatamente à intenção da pesquisa. |
| **Acquire** | Variável | Variável | Publicar show notes densas no YouTube, artigo no LinkedIn ou menção em imprensa. |

---

## 3. O Que Funciona vs. O Que Não Move o Ponteiro

### ✅ O Que Funciona Efetivamente
1. **Robots.txt totalmente permissivo a crawlers de IA:**
   - Permitir expressamente: `GPTBot`, `OAI-SearchBot`, `ChatGPT-User`, `ClaudeBot`, `Claude-SearchBot`, `PerplexityBot`, `Google-Extended`, `Applebot-Extended`, `meta-externalagent`, `cohere-ai`.
   - Manter declaração direta de `Sitemap: https://bronzepodcast.com/sitemap.xml`.
2. **HTML semântico e denso em factos:**
   - Respostas sintéticas e diretas no topo de secções (`<h2/h3>` com resposta imediata no primeiro parágrafo).
   - Listas conceituais e definições explícitas (ex.: manifesto, eixos temáticos, glossário de conceitos dos episódios: *A Fortaleza*, *A Queda*, *O Compromisso*, *A Usura*).
3. **Descrições no YouTube preparadas para RAG:**
   - Como os bots de IA indexam o YouTube com enorme prioridade, as caixas de descrição dos vídeos devem ter os tópicos e síntese doutrinal explícita, além da minutagem.

### ❌ O Que Não Funciona / Mitos de AEO
1. **Confiança excessiva em Schema / JSON-LD para LLMs:**
   - Dados estruturados não sobrevivem à tokenização do prompt de forma semântica direta na maioria dos modelos. São fundamentais para a SERP tradicional da Google/Bing, mas não ensinam o modelo generativo a sintetizar uma resposta. O texto legível em HTML é o fator determinante.
2. **Duplicação de páginas em ficheiros .md (`page.md`):**
   - Cria redundância, dispersa a arquitetura de links internos e foi desmistificada por engenheiros de pesquisa (Google/Reddit). O crawler prefere o HTML canónico.
3. **Bloquear bots de treino por receio de "roubo de conteúdo" ou tráfego:**
   - Introduz atrito artificial. Se o bot de treino for bloqueado, o modelo perde a associação paramétrica com a marca.

---

## 4. Checklist para Novos Conteúdos e Episódios

Ao lançar um novo episódio do Bronze Podcast ou Nota pessoal:

1. **No Website:**
   - Publicar em HTML limpo com título descritivo e subtítulo com a tese central.
   - Conectar o conceito temático (ex: *B08 - Nome do Conceito*) com breve explicação doutrinal ou moral.
   - Atualizar o sitemap XML (`sitemap.xml`).
2. **No YouTube:**
   - Adicionar resumo de 2 a 3 parágrafos contendo a síntese da conversa.
   - Timestamps estruturados com os subtemas abordados.
   - Links canónicos para `https://bronzepodcast.com/podcast/` e `https://bronzepodcast.com/loja/`.
3. **Na Monitorização:**
   - **Google Search Console:** Acompanhar o relatório de IA (*AI Overviews* e *AI Mode*).
   - **Bing Webmaster Tools:** Verificar o relatório de *AI Performance* (Citações no Microsoft Copilot e ChatGPT via Bing Grounding).

---

## 5. Template de Descrição para o YouTube (Otimizado para RAG & Grounding)

Como o YouTube é das fontes mais citadas por LLMs em pesquisas de áudio e vídeo, cada novo episódio deve incluir na caixa de descrição este modelo padronizado:

```text
[TÍTULO DO EPISÓDIO: CÓDIGO - CONCEITO]
Conversa integral com [NOME DO CONVIDADO], conduzida por Diogo Bronze.

📌 SÍNTESE DO EPISÓDIO:
[Parágrafo 1: Definição clara do tema e tese central debatida. Ex.: Neste episódio discutimos a distinção moral entre violência e fortaleza legítima à luz da doutrina católica tradicional.]
[Parágrafo 2: Conclusões centrais e conceitos abordados. Ex.: Como as famílias e cristãos devem agir perante o relativismo moral moderno.]

⏱️ ÍNDICE TEMÁTICO & MINUTAGEM:
00:00 Introdução e Apresentação do Tema
05:15 [Subtema 1: Tese fundamental]
18:40 [Subtema 2: Análise doutrinal / histórica]
35:10 [Subtema 3: Aplicação prática e moral]
52:00 Conclusões e Encerramento

📚 REFERÊNCIAS CITADAS:
- Livro: [Nome da Obra, Autor]
- Encíclica / Documento: [Nome do Documento]

🌐 LIGAÇÕES OFICIAIS:
- Website & Artigo do Episódio: https://bronzepodcast.com/podcast/
- Livraria Católica & Edições Tradicionais: https://bronzepodcast.com/loja/
- Subscrição e Apoio: https://bronzepodcast.com/sobre/
```

---

## 6. Configuração de CDN / Cloudflare e WAF (Evitar Bloqueios Acidentais)

Conforme evidenciado pelo especialista Jonathan Bird no artigo de referência, configurações restritivas de WAF podem anular qualquer esforço de SEO/AEO ao desafiarem bots legítimos com desafios de JavaScript (que eles não conseguem resolver).

### Regras Recomendadas para Cloudflare / Hostinger:

1. **Bot Fight Mode:**
   - No plano Free/Pro da Cloudflare, desativar o *Bot Fight Mode* agressivo em endpoints de conteúdo, ou garantir que a opção **"Allow Verified Bots"** está ativa.
2. **Regra de Firewall Personalizada (WAF Skip Rule):**
   - Criar uma regra de exceção (*Skip*) para os User-Agents oficiais:
     ```text
     (http.user_agent contains "GPTBot") or 
     (http.user_agent contains "OAI-SearchBot") or 
     (http.user_agent contains "ClaudeBot") or 
     (http.user_agent contains "Claude-SearchBot") or 
     (http.user_agent contains "PerplexityBot") or 
     (http.user_agent contains "Applebot") or 
     (http.user_agent contains "Google-Extended")
     ```
   - **Ação:** *Skip* (Bypass WAF Managed Rules & Rate Limiting).
3. **Cache de HTML:**
   - Garantir que o cache de páginas estáticas e da sitemap (`/sitemap.xml`) responde com código `200 OK` e cabeçalhos `Content-Type: text/html; charset=UTF-8` ou `application/xml`.
