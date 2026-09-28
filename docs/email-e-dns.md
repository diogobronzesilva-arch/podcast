# Email e DNS do Bronze Podcast

Estado verificado em 28 de setembro de 2026 no domínio `bronzepodcast.com` e no WordPress publicado.

## Receção

- O Cloudflare Email Routing recebe as mensagens do domínio e encaminha-as para o Gmail verificado.
- `info@bronzepodcast.com` tem uma regra própria ativa para esse destino.
- O catch-all está ativo para os restantes endereços. Um endereço de teste sem regra própria foi aceite pelo Cloudflare e aparece no Activity Log com resultado `Forwarded`.
- O Email Routing encaminha mensagens; não cria uma caixa de correio independente.

## Envio pelo WordPress atual

- O FluentSMTP usa a ligação predefinida do Resend para enviar mensagens do WordPress como `info@bronzepodcast.com`.
- Configuração SMTP: `smtp.resend.com`, porta `465`, SSL, utilizador `resend`.
- A chave de API fica guardada no WordPress e nunca deve ser incluída neste repositório.
- O teste do FluentSMTP foi entregue. Também foram recebidos no Gmail o teste do formulário de contacto e o email de teste das notificações WooCommerce.
- O remetente configurado no WooCommerce é `info@bronzepodcast.com`.

## Titan e outros endereços

`info@bronzepodcast.com` já não depende da Titan: a receção passa pelo Cloudflare e o envio do WordPress pelo Resend.

A caixa Titan `diogo@bronzepodcast.com` ainda contém correspondência operacional recente sobre uma encomenda. O catch-all encaminha agora endereços sem regra própria para o Gmail, mas isso não migra o histórico nem o envio dessa conta. Antes de cancelar a subscrição Titan, migrar o envio de `diogo@` e arquivar o histórico necessário.

Os registos Titan que ainda aparecem no DNS foram mantidos: `titan2._domainkey`, os seletores `pdn1evcb1222._domainkey` e `pdn2evcb1222._domainkey`, e `pds.pdrserv`. Não os remover enquanto a conta `diogo@` não tiver sido migrada.

## Estado DNS observado

- Os três registos MX ativos são do Cloudflare Email Routing.
- O SPF da raiz é `v=spf1 include:_spf.mx.cloudflare.net ~all`.
- Os registos de envio do Resend (`send`, `rsend` e `resend._domainkey`) continuam presentes.
- O DMARC está em modo de monitorização: `v=DMARC1; p=none;`. Rever a política depois de confirmar todos os remetentes ativos, incluindo a Titan.
- O painel Cloudflare assinala que `ftp.bronzepodcast.com` está em modo DNS-only e revela o mesmo IP de origem do domínio. Não foi alterado porque pode ser necessário para acesso FTP; confirmar primeiro se esse nome ainda é usado.

## Separação entre site atual e staging

Esta configuração foi aplicada ao WordPress atualmente publicado. A instalação de staging e qualquer futura migração de tema devem ser verificadas separadamente antes da publicação.
