# Email e DNS do Bronze Podcast

Estado verificado em 28 de setembro de 2026 para o domínio `bronzepodcast.com`.

## Receção

- O Cloudflare Email Routing recebe as mensagens do domínio.
- O endereço `info@bronzepodcast.com` está ativo e reencaminha para o destino Gmail verificado no Cloudflare.
- O catch-all continua desligado enquanto se aguarda confirmação para encaminhar mensagens destinadas a qualquer outro endereço do domínio.
- O Email Routing é reencaminhamento; não cria uma caixa de correio independente.

## Envio pelo WordPress atual

- O FluentSMTP usa a ligação predefinida do Resend para enviar mensagens do WordPress como `info@bronzepodcast.com`.
- Configuração SMTP: `smtp.resend.com`, porta `465`, SSL, utilizador `resend`.
- A chave de API fica guardada no WordPress e nunca deve ser incluída neste repositório.
- Um email de teste foi marcado como entregue no Resend e confirmado na caixa de correio de destino.

## Titan

O endereço `info@bronzepodcast.com` já não depende da Titan: o Cloudflare trata da receção e o Resend do envio do WordPress. Antes de cancelar uma subscrição Titan, confirmar que não existem outras caixas de correio ou serviços do domínio ainda dependentes dela e guardar qualquer histórico que seja necessário.

## Separação entre site atual e staging

Esta configuração foi aplicada ao WordPress atualmente publicado. A instalação de staging e qualquer futura migração de tema devem ser verificadas separadamente antes da publicação.
